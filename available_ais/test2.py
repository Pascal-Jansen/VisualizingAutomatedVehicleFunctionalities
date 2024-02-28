import os
import time
import datetime

# define path
source = "/var/www/available_ais/uploads/"
dir_list = []

#function to start the different models on the new uploads
def run_models(entry_path):
    dir_list_of_entry = os.listdir(source + entry_path)
    print("Inside of the dir is:")
    for item in dir_list_of_entry:
        print("\t" + item)
    if len(dir_list_of_entry) == 1:
        if item == entry_path + ".mp4":
            print("Starting to run models.")
            os.system("python test1.py " + entry_path)
            #os.system("sudo -u www-data python3 test1.py " + entry_path)
            return 1
        elif item == entry_path + ".mp4.part":
            print("File is still being uploaded.")
            return 2
        else:
            print("False file detected")
            return 2
    elif len(dir_list_of_entry) == 7:
        print("Already all 7 files in directory.")  
        print("Not starting models.")
        return 1  
    else:
        print("More than one, but less than six files inside directory.")
        print("Not starting models.")
        return 0

#loop over source dir
while True:
    #get every file and dir in source path
    new_dir_list = os.listdir(source)
    #check for new entry in source path
    if new_dir_list != dir_list:
        #list of new and deleted items between last and current loop
        del_items_list = list(set(dir_list) - set(new_dir_list))
        upd_items_list = list(set(new_dir_list) - set(dir_list))
        
        #print new and deleted items
        if len(del_items_list) > 0:
            print("Deleted item detected:")
            print(del_items_list)
        if len(upd_items_list) > 0:
            print("New entry detected:")
            print(upd_items_list)
        
        #loop over new entries
        for new_entry in upd_items_list:
            print("Current entry:")
            new_entry_path = source + new_entry
            print("\t" + new_entry_path)
            is_dir = os.path.isdir(new_entry_path)
            if is_dir:
                print("New entry is a directory.")
                return_val = run_models(new_entry)
                if return_val == 2 or return_val == 0:
                    try:
                        print("Trying to remove item from new_entry_list")
                        new_dir_list.remove(new_entry)
                    except ValueError:
                        print("Couldn't remove item from new_entry_list")
                    else:
                        print("Item was successfully removed")

            else:
                print("New entry is not a directory.")

        #update dir list of last loop to list of current loop
        dir_list = new_dir_list

    else:
        now = datetime.datetime.now()
        if now.minute == 0 or now.minute == 15 or now.minute == 30 or now.minute == 45:
            print("No new entry at: " + str(now.day) + "." + str(now.month) + "  " + str(now.hour) + ":" + str(now.minute) + ":" + str(now.second))
        
    #wait 60 seconds after each loop
    time.sleep(60) 

