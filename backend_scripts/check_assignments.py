#!/usr/bin/python

import socket
import subprocess
import git
import os.path

from database import *
import crack_wpa

# File created when assignment is still running
file_busy = '/tmp/busy'

def opdrachtvolbracht():
	os.remove(file_busy)
	query = 'update assignments SET status = "executed" where assignments_id ="'
	query+= str(cmd_id)
	query+= '";'
	executequery(query)
 
def opdrachterror(errormsg):
	os.remove(file_busy)
	query = 'update assignments SET status = "error", parameter="'
	query+= errormsg
	query+= '" where assignments_id="'
	query+= str(cmd_id)
	query+= '";'
	print(query)
	executequery(query)

def opdrachtexecute():
	open(file_busy, 'a').close()
	query= 'update assignments SET status = "busy" where assignments_id="'
	query+= str(cmd_id)
	query+= '";'
	executequery(query)

def lastseen():
	# # Update last seen
	query='update units set last_seen = now() where caption="'
	query+=socket.gethostname()
	query+='";'
	executequery(query)

# Check into our hotel ..erm..website
lastseen()

# All your command are belong to us
query = "select assignment,assignments_id,parameter from assignments where caption='"
query+= socket.gethostname()
query+= "' and status='new' order by assignments_id ASC limit 1;"
tmp = executequery(query)
if tmp:
	command    = tmp[0][0]
	cmd_id     = tmp[0][1]
	parameter  = tmp[0][2]
else:
	print('No commands atm.')
	quit()

# Quit when there is an assignment still running
if os.path.isfile(file_busy):
	print('Still busy or no command	!')
	quit()

print('- Assignment check')
# Check for assignments
if command == "crack_wpa":
	try:
		opdrachtexecute()
		print ("oprdacht uitvoeren")
		paraparts= parameter.split("|")
		crack_wpa.automate(paraparts[0],paraparts[1], paraparts[2])
		opdrachtvolbracht()
	except Exception, e:
		opdrachterror(str(e))
