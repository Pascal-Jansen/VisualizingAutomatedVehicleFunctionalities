from detectron2.engine import DefaultPredictor
from detectron2.config import get_cfg
from detectron2.data import MetadataCatalog
from detectron2.utils.visualizer import ColorMode, Visualizer
from detectron2 import model_zoo

import cv2
import numpy as np

class Detector:
	def __init__(self, model_type = "OD"):
		self.cfg = get_cfg()
		self.model_type = model_type

		#Load model config and pretrained model
		if model_type == "OD": #object detection
			self.cfg.merge_from_file(model_zoo.get_config_file("COCO-Detection/faster_rcnn_R_101_FPN_3x.yaml"))
			self.cfg.MODEL.WEIGHTS = model_zoo.get_checkpoint_url("COCO-Detection/faster_rcnn_R_101_FPN_3x.yaml")
		elif model_type == "IS": #instance segmentation
			self.cfg.merge_from_file(model_zoo.get_config_file("COCO-InstanceSegmentation/mask_rcnn_X_101_32x8d_FPN_3x.yaml"))
			self.cfg.MODEL.WEIGHTS = model_zoo.get_checkpoint_url("COCO-InstanceSegmentation/mask_rcnn_X_101_32x8d_FPN_3x.yaml")
		elif model_type == "KP": #keypoint detection
			self.cfg.merge_from_file(model_zoo.get_config_file("COCO-Keypoints/keypoint_rcnn_X_101_32x8d_FPN_3x.yaml"))
			self.cfg.MODEL.WEIGHTS = model_zoo.get_checkpoint_url("COCO-Keypoints/keypoint_rcnn_X_101_32x8d_FPN_3x.yaml")
		elif model_type == "LVIS": #LVIS Segmentation
			self.cfg.merge_from_file(model_zoo.get_config_file("LVISv0.5-InstanceSegmentation/mask_rcnn_X_101_32x8d_FPN_1x.yaml"))
			self.cfg.MODEL.WEIGHTS = model_zoo.get_checkpoint_url("LVISv0.5-InstanceSegmentation/mask_rcnn_X_101_32x8d_FPN_1x.yaml")
		elif model_type == "PS": #Panoptic Segmentation
			self.cfg.merge_from_file(model_zoo.get_config_file("COCO-PanopticSegmentation/panoptic_fpn_R_101_3x.yaml"))
			self.cfg.MODEL.WEIGHTS = model_zoo.get_checkpoint_url("COCO-PanopticSegmentation/panoptic_fpn_R_101_3x.yaml")



		self.cfg.MODEL.ROI_HEADS.SCORE_THRESH_TEST = 0.7
		self.cfg.MODEL.DEVICE = "cuda" #cpu or cuda

		self.predictor = DefaultPredictor(self.cfg)

	def onImage(self, imagePath):
		image = cv2.imread(imagePath)
		if self.model_type != "PS":
			predictions = self.predictor(image)

			viz = Visualizer(image[:,:,::-1], metadata = MetadataCatalog.get(self.cfg.DATASETS.TRAIN[0]),
			instance_mode = ColorMode.IMAGE_BW)

			output = viz.draw_instance_predictions(predictions["instances"].to("cpu"))

		else:
			predictions, segmentInfo = self.predictor(image)["panoptic_seg"]
			viz = Visualizer(image[:,:,::-1], MetadataCatalog.get(self.cfg.DATASETS.TRAIN[0]))
			output = viz.draw_panoptic_seg_predictions(predictions.to("cpu"), segmentInfo)

		cv2.imwrite('images/1_result.jpg', output.get_image()[:,:,::-1])

		#cv2.imshow("Result", output.get_image()[:,:,::-1])
		#cv2.waitKey(0)

	def write_video(self, filename, frames, fps):
		fps = max(1, fps)
		out = None
		frameSize = (1280, 720)

		try:
			for image in frames:

				if not out:
					height, width, channels = frame.shape
					fourcc = cv2.VideoWriter_fourcc(*'mp4v')
					out = cv2.VideoWriter(str(filename), fourcc, fps, frameSize, isColor=True)

				out.write(image)

		finally:
			out and out.release()
			cv2.destroyAllWindows()

	def write_video_2(self, file_path, frames, fps):
		w, h = frames[0].size
		fourcc = cv.VideoWriter_fourcc('m', 'p', '4', 'v')
		writer = cv.VideoWriter(file_path, fourcc, fps, (w, h))

		for frame in frames:
			writer.write(pil_to_cv(frame))

		writer.release() 



	def onVideo(self, videoPath):
		cap = cv2.VideoCapture(videoPath)
		img_array = []

		if (cap.isOpened() == False):
			print ("Error opening the file...")
			return

		(success, image) = cap.read()

		while success:
			if self.model_type != "PS":
				predictions = self.predictor(image)

				viz = Visualizer(image[:,:,::-1], metadata = MetadataCatalog.get(self.cfg.DATASETS.TRAIN[0]),
				instance_mode = ColorMode.IMAGE_BW)

				output = viz.draw_instance_predictions(predictions["instances"].to("cpu"))

			else:
				predictions, segmentInfo = self.predictor(image)["panoptic_seg"]
				viz = Visualizer(image[:,:,::-1], MetadataCatalog.get(self.cfg.DATASETS.TRAIN[0]))
				output = viz.draw_panoptic_seg_predictions(predictions.to("cpu"), segmentInfo)

			img_array.append(output.get_image()[:,:,::-1])
			(success, image) = cap.read()

		self.write_video("images/test_result.mp4", img_array, 30)
		#self.write_video_2("images/test_result.mp4", img_array, 30)
