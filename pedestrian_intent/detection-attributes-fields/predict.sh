#this script makes a prediction for each image in a given folder

################################################################
#echo Insert path to images ex. c:/input/folder/
#path="$HOME/videos/pedes_int/ulm_video_10s_pics/"
#read path
path=$1
echo $path

#echo Insert path to output folder
#output=~/results/pedes_int/ulm_video_10s_pics_result/
#read output
output=$2
echo $output

timestamp() {
   date "+%T"
}

timeBeginning=$(timestamp)

for file in ${path}*
do
   echo Now Predicting File: ${file}
   python -m openpifpaf.predict -o ${output} --checkpoint openpifpaf_detection_attributes/models/mtlfields_32attributes_jaad.pt ${file}
   echo Prediction complete!
done
echo $timeBeginning
timestamp