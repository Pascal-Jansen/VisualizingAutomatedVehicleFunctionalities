import os
import subprocess
import sys
import signal
from time import sleep
#os.system('lt --port 80 --subdomain aiscepticism -o --print-requests')



def execute(command):
    process = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE, stderr=subprocess.STDOUT, preexec_fn=os.setsid)

    # Poll process for new output until finished
    while True:
        nextline = process.stdout.readline()
        if nextline == '' and process.poll() is not None:
            break
        nextline = str(nextline)
        if nextline.find("your url is:") != -1:
            if nextline.find("https://aiscepticism.loca.lt") == -1:
                sys.stdout.write("False url detected:" + nextline + "\n")
                os.killpg(os.getpgid(process.pid), signal.SIGTERM)
                break
        if nextline.find("Error:") != -1:
            sys.stdout.write("Error detected:" + nextline + "\n")
            os.killpg(os.getpgid(process.pid), signal.SIGTERM)
            break
        sys.stdout.write(nextline + "\n")
        sys.stdout.flush()

    output = process.communicate()[0]
    exitCode = process.returncode

    if (exitCode == 0):
        return + output
    else:
        sys.stdout.write("error")
        sleep(5)
        execute('lt --port 80 --subdomain aiscepticism -o --print-requests')

execute('lt --port 80 --subdomain aiscepticism -o --print-requests')