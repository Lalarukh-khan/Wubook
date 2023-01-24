FROM ubuntu:latest

ARG sasurl
ARG DEBIAN_FRONTEND=noninteractive
ENV TZ=Etc/UTC

WORKDIR /var/www/html
# Installing Esentials
RUN apt-get update && \
    apt-get install -y ant && \
    apt-get clean && \
    apt-get install -y zip unzip curl sqlite git bash tzdata && \
    sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd

# Installing PHP
RUN apt install -y software-properties-common && \ 
    add-apt-repository ppa:ondrej/php && \
    apt update && \
    apt-get install -y php7.4 php7.4-fpm php7.4-common php7.4-mysql php7.4-bcmath openssl php7.4-json php7.4-mbstring php7.4-ctype php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-opcache php7.4-soap php7.4-zip php7.4-intl

# Installing and Configuring OpenSSH Server
RUN apt-get install -y --no-install-recommends openssh-server && \
    echo "root:Docker!" | chpasswd
#configure ssh server
COPY sshd_config /etc/ssh/

# Installing composer
#RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
#    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
#    rm -rf composer-setup

# Configure Nginx
#RUN apt install -y nginx && rm /etc/nginx/sites-available/default && rm /etc/nginx/sites-enabled/default && echo "daemon off;" >> /etc/nginx/nginx.conf
#COPY main.conf /etc/nginx/conf.d/
#RUN ln -sf /dev/stdout /var/log/nginx/access.log && \
#    ln -sf /dev/stderr /var/log/nginx/error.log && \
#    echo "exit 0" > /usr/sbin/policy-rc.d

# make directory in html folder
RUN mkdir /var/www/html/wubook

# copy files to linux filesystem
COPY . wubook/

# download .env file from storage account
#RUN curl -o .env "$sasurl" && cp .env wubook/

# Permissions configurations for wubook
  #chown the root directory:
#RUN chown -R www-data:www-data /var/www/html/wubook
  #Set file permission to 644:
#RUN find /var/www/html/wubook -type f -exec chmod 644 {} \;
  #Set directory permission to 755:
#RUN find /var/www/html/wubook -type d -exec chmod 755 {} \;
  #Give rights for web server to read and write storage and cache
#RUN chgrp -R www-data /var/www/html/wubook/storage && \
#    chmod -R ug+rwx /var/www/html/wubook/storage

WORKDIR /var/www/html/wubook

# Building process
#RUN 

#copy init script
#COPY init.sh /home/pms/init.sh
#RUN chmod 755 /home/pms/init.sh
#expose ssh n nginx ports
EXPOSE 22 8080
#run entry script
#ENTRYPOINT ["/home/pms/init.sh"]
CMD /etc/init.d/ssh start && php -S 0.0.0.0:8080 -t public
