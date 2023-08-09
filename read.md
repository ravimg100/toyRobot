Main code file - toyRobot.php
Instructions for robot provided in - toyRobotCommands.csv

terminal command to run the code - php -r "require 'toyRobot/toyRobot.php'; simulate('/var/www/html/toyRobot/toyRobotCommands.csv');"

Test cases done:
a)
PLACE 0,0,NORTH
MOVE
REPORT
Output: 0,1,NORTH

b)
PLACE 0,0,NORTH
LEFT
REPORT
Output: 0,0,WEST

c)
PLACE 1,2,EAST
MOVE
MOVE
LEFT
MOVE
REPORT
Output: 3,3,NORTH

d)
MOVE
OutPut - Cannot move, robot not yet placed

e)
PLACE 0,0,NORTH
MOVE
MOVE
MOVE
MOVE
LEFT
LEFT
LEFT
MOVE
MOVE
MOVE
MOVE
REPORT
Output - 4,4,EAST

f)
PLACE 0,0,NORTH
MOVE
RIGHT
MOVE
LEFT
MOVE
RIGHT
MOVE
LEFT
MOVE
RIGHT
MOVE
LEFT
MOVE
RIGHT
MOVE
LEFT
MOVE
RIGHT
MOVE
LEFT
MOVE
RIGHT
MOVE
LEFT
REPORT
Output -  Cannot move further, reached north boundary 
4,5,EAST

