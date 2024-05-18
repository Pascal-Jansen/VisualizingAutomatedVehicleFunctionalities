# Visualizing Imperfect Situation Detection and Prediction in Automated Vehicles: Understanding Users’ Perceptions via User-Chosen Scenarios

### [Pascal Jansen*](https://scholar.google.de/citations?user=cR1_0-EAAAAJ), [Mark Colley*](https://scholar.google.de/citations?user=Kt5I7wYAAAAJ&hl=en), Tim Pfeifer and Enrico Rukzio

*Joint First Authors

![teaser_user-uploaded-videos-with-overlays](https://github.com/Pascal-Jansen/VisualizingAutomatedVehicleFunctionalities/assets/28151101/aaa920e5-d388-4574-b8ba-d0f592238ca1)

User acceptance is essential for successfully introducing automated vehicles (AVs). Understanding the technology is necessary to overcome scepticism and achieve acceptance. This could be achieved by visualizing (uncertainties of) AV's internal processes, including situation perception, prediction, and maneuver planning. Simultaneously, relevant scenarios to communicate the functionalities are unclear. Therefore, we developed EduLicit to concurrently elicit relevant scenarios and evaluate the effects of visualizing AV's internal processes. A website capable of showing annotated videos enabled this methodology. With this, we could replicate the results of a previous online study (N=76) using pre-recorded real-world videos. Additionally, in a second online study (N=22), participants uploaded scenarios they deemed challenging for AVs using our website. We found that most scenarios included large intersections and/or multiple vulnerable road users (see figure above). Our work helps assess scenarios perceived as challenging for AVs by the public and, at the same time, can help educate the public about visualizations of the capabilities of current AVs.


## Overview
This repository hosts the code for applying the EduLicit method for visualizing AVs internal functionalities.
It includes the [Detectron2](https://github.com/facebookresearch/detectron2) panoptic segmentation model, pedestrian intention model [detection attributes fields](https://github.com/vita-epfl/detection-attributes-fields), and the website code for conducting surveys on AV capabilities that allow user video upload (see figure below).

![video_pipeline_edulicit](https://github.com/Pascal-Jansen/VisualizingAutomatedVehicleFunctionalities/assets/28151101/e793629d-0c1c-4eae-98df-6d4af9bc7d51)


## Setup and Running the EduLicit Website
**1. Apache Webserver**:
For setting up the server, follow the instructions in [this Apache Webserver tutorial](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04).

**2. You need to run the following scripts with Python**: 
  - `test2.py`: checks for new video uploads and starts the `test1.py` with the filename of the uploaded file as an argument, which is also the user-id (e.g., a [Prolific](https://www.prolific.com/) ID) of the user who uploaded the file.
  - `test4.py`: starts the [localtunnel](https://github.com/localtunnel/localtunnel) with the handed subdomain, ensuring it remains active and restarts upon errors.

## Applying the Visualization Models on a Specific Video
You can also separately apply the semantic segmentation (Detectron2) and the pedestrian intention models on a specified video without using the website. For instance, this can be used to prepare (i.e., pre-visualize) the videos that will be shown to participants in a survey instead or in addition to enabling custom-video uploads.


### Anaconda Environment
Download the latest version of [Anaconda](https://www.anaconda.com/products/distribution#Downloads). Refer to the [official installation guide](https://docs.anaconda.com/anaconda/install/) for detailed steps.

**Environment Setup**: 
  - Create a Python 3.8 environment using `conda create -n test_env python=3.8`.
  - Activate the environment with `conda activate test_env`.
  - Note: The current environment is indicated in the terminal prompt (e.g., `(test_env) $`).

**Package Installation**: Install packages within the environment using `conda install PACKAGE`. Example: `conda install pytorch torchvision torchaudio cudatoolkit=11.3 -c pytorch`.

**Resource**: For various Anaconda commands, refer to the [Anaconda cheatsheet](https://docs.conda.io/projects/conda/en/4.6.0/_downloads/52a95608c49671267e40c689e0bc00ca/conda-cheatsheet.pdf).


### Running the Pedestrian Intent Model
Clone the [original repository](https://github.com/vita-epfl/detection-attributes-fields) and follow its [installation guide](https://github.com/vita-epfl/detection-attributes-fields#installation).

**File Modifications**: 
  - Replace `painter.py` in `detection-attributes-fields/openpifpaff_detection_attributes/datasets` with the version in the `other/` directory.
  - Update `painters.py` in `openpifpaf` using the file from `other/`.
  - If encountering a `FileNotFoundError`, copy `other/pedestrianError/` to the indicated directory.

**Usage Example**:
```
python -m openpifpaf.video --source [source.mp4] --video-output [output.mp4] --checkpoint openpifpaf_detection_attributes/models/mtlfields_32attributes_jaad.pt --video-dpi 150 --video-fps 25
```

### Running the Detectron2 Model
Clone this repository or the [original Detectron2 repository](https://github.com/facebookresearch/detectron2). Follow the provided [installation steps](https://detectron2.readthedocs.io/en/latest/tutorials/install.html) for proper environment setup.

**Custom Modifications**: This repo includes custom changes to the Detectron2 model:
- Specific colors and categories defined in `video_visualizer.py` line 276-292 and `visualizer.py` line 215-218, 227-229.
- Adjusted alpha values to 0.2 for better visualization in `video_visualizer.py and visualizer.py`.
- Text labels were removed in `visualizer.py` line 743-749 for a cleaner output.

**Usage Example**:
```
python demo.py --config-file ./detec2/detectron2/configs/COCO-PanopticSegmentation//panoptic_fpn_R_101_3x.yaml --video-input [video-input.mp4] --output [output.mp4] --opts MODEL.WEIGHTS detectron2://COCO-PanopticSegmentation/panoptic_fpn_R_101_3x/139514519/model_final_cafdb1.pkl
```

Important: Use the `MODEL.WEIGHTS` argument to ensure the model uses the correct trained weights.

For more detailed instructions and documentation, refer to the respective directories of each model within this repository.
