import os
import sys
from datetime import datetime
from time import sleep
import getpass

path = "uploads/"
list_of_args = sys.argv
entry = list_of_args[1]

#change permissions of target folder
path_to_folder = path + entry + "/" 

PSconfig = "~/ModelTests/detec2/detectron2/configs/COCO-PanopticSegmentation/panoptic_fpn_R_101_3x.yaml"
PSweights = "detectron2://COCO-PanopticSegmentation/panoptic_fpn_R_101_3x/139514519/model_final_cafdb1.pkl"

checkpointPathPI = "~/ModelTests/pedestrian_intent/detection-attributes-fields/openpifpaf_detection_attributes/models/mtlfields_32attributes_jaad.pt"
videoOutputPathPI = "/var/www/available_ais/" + path + entry + "/" + entry + "_720p_25_fps_result_pi.mp4"
videoOutputPathPIPS = "/var/www/available_ais/" + path + entry + "/" + entry + "_720p_25_fps_result_pi_ps.mp4"
videoConvertedOutputPathPIPS = "/var/www/available_ais/" + path + entry + "/" + entry + "_720p_25_fps_result_pi_ps_converted.mp4"
videoInputPathPI = "/var/www/available_ais/" + path + entry + "/" + entry + "_720p_25_fps.mp4"

#videoInputPath = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz.mp4'
#videoOutputPathIS = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz_result_is.mp4'
#videoConvertedOutputPathIS = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz_result_is_converted.mp4'
#videoOutputPathPS = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz_result_ps.mp4'
#videoConvertedOutputPathPS = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz_result_ps_converted.mp4'
#videoOutputPathOD = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz_result_od.mp4'
#videoConvertedOutputPathOD = 'uploads/qwertzqwertzqwertzqwertz/qwertzqwertzqwertzqwertz_result_od_converted.mp4'
demoPath = "~/ModelTests/detec2/detectron2/demo/demo.py"

#cmd1 = demoPath . " --config-file  " . ISconfig . "  --video-input  " . videoInputPath . " --output " . videoOutputPath . " --opts MODEL.WEIGHTS " . ISweights
#cmd11 = "ffmpeg -y -vsync 0 -hwaccel cuda -hwaccel_output_format cuda -i " . videoOutputPath . " -c:a copy -c:v h264_nvenc -b:v 5M " . videoConvertedOutputPath
#is_cmd = "python " + demoPath + " --config-file " + ISconfig + " --video-input " + videoInputPath + " --output " + videoOutputPathIS + " --opts MODEL.WEIGHTS " + ISweights
#is_cmd_2 = "ffmpeg -y -vsync 0 -hwaccel cuda -hwaccel_output_format cuda -i " + videoOutputPathIS + " -c:a copy -c:v h264_nvenc -b:v 5M " + videoConvertedOutputPathIS

#ps_cmd = "python " + demoPath + " --config-file " + PSconfig + " --video-input " + videoInputPath + " --output " + videoOutputPathPS + " --opts MODEL.WEIGHTS " + PSweights
ps_cmd_2 = "ffmpeg -y -vsync 0 -hwaccel cuda -hwaccel_output_format cuda -i " + videoOutputPathPIPS + " -c:a copy -c:v h264_nvenc -b:v 5M " + videoConvertedOutputPathPIPS

#od_cmd = "python " + demoPath + " --config-file " + ODconfig + " --video-input " + videoInputPath + " --output " + videoOutputPathOD + " --opts MODEL.WEIGHTS " + ODweights
#od_cmd_2 = "ffmpeg -y -vsync 0 -hwaccel cuda -hwaccel_output_format cuda -i " + videoOutputPathOD + " -c:a copy -c:v h264_nvenc -b:v 5M " + videoConvertedOutputPathOD

#is model start and ffmpeg convertion
#os.system(is_cmd)
#os.system("conda run -n base " + is_cmd_2)

#ps model start and ffmpeg convertion
#os.system(ps_cmd)
#os.system("conda run -n base " + ps_cmd_2)

#od model start and ffmpeg convertion
#os.system(od_cmd)
#os.system("conda run -n base " + od_cmd_2)

#neuer panoptic model befehl

ps_cmd_neu = "python " + demoPath + " --config-file " + PSconfig + " --video-input " + videoOutputPathPI + " --output " + videoOutputPathPIPS + " --opts MODEL.WEIGHTS " + PSweights

pi_cmd = "python3 -m openpifpaf.video --source " + videoInputPathPI + " --video-output " + videoOutputPathPI + " --checkpoint " + checkpointPathPI + " --video-dpi 150 --video-fps 25"

video_dim_ret_val = os.popen("ffprobe -v error -select_streams v:0 -show_entries stream=width,height -of default=nw=1:nk=1 " +  path + entry + "/" + entry + ".mp4").read()
video_fps_ret_val = os.popen("ffprobe -v error -select_streams v -of default=noprint_wrappers=1:nokey=1 -show_entries stream=r_frame_rate " +  path + entry + "/" + entry + ".mp4").read()

video_dim_arr = video_dim_ret_val.split("\n")
video_fps_arr = video_fps_ret_val.split("/")

video_dim = video_dim_arr[1]
video_fps = video_fps_arr[0]

if int(video_dim) != 720:
    os.system("ffmpeg -i " + path + entry + "/" + entry + ".mp4 -vf scale=-1:720,'pad=ceil(iw/2)*2:ceil(ih/2)*2' -c:v libx264 -crf 18 -c:a copy " + path + entry + "/" + entry + "_720p.mp4")
else:
    os.system("cp "+ path + entry + "/" + entry + ".mp4 " + path + entry + "/" + entry + "_720p.mp4")

if int(video_fps) > 25:
    os.system("ffmpeg -i " + path + entry + "/" + entry + "_720p.mp4 -filter:v fps=25 -c:v libx264 " +path + entry + "/" + entry + "_720p_25_fps.mp4")
else:
    os.system("cp "+ path + entry + "/" + entry + "_720p.mp4 " + path + entry + "/" + entry + "_720p_25_fps.mp4")


os.chdir("/home/tim/ModelTests/pedestrian_intent/detection-attributes-fields/")
os.system("conda run -n pedes_int " + pi_cmd)
os.chdir("/var/www/available_ais/")

os.system("conda run -n detectron_env " + ps_cmd_neu)
os.system("conda run -n base " + ps_cmd_2)

os.system('echo "done" > ' + path + entry + "/" + entry + '_done.txt')
