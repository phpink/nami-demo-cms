#!/bin/bash

# Add user defined by DOCKER_USER environment variable
echo "Create user developer"
groupmod -g $GID $DOCKER_GROUP
useradd -u $UID -g $DOCKER_GROUP -ms /bin/bash $DOCKER_USER

#Password
echo Set User/Password: $DOCKER_USER:$DOCKER_USER_PASSWORD
echo $DOCKER_USER:$DOCKER_USER_PASSWORD | chpasswd

echo "Set sudo privilege"
adduser $DOCKER_USER sudo

# Add Aliases and color in .bashrc
echo "Force color prompt"
sed -i "/alias l/s/^#//g ;/force_color_prompt=yes/s/^#//g" /home/$DOCKER_USER/.bashrc

echo "Launch php fpm"
php-fpm
