FROM nginx:1.20 as base

ENV NGINIX_SERVER_NAME "localhost"
ENV NGINIX_UPSTREAM_SERVER "app_php"
ENV NGINIX_UPSTREAM_SERVER_PORT "9000"
ENV NGINIX_ROOT "/var/www/public"
ENV APP_ROOT "/var/www/"
ENV NGINIX_LISTEN_PORT "80"
ENV NGINIX_HTTP_PORT "80"
ENV NGINIX_HTTPS_PORT "443"
ENV IS_PRODUCTION 0
ENV NODE_EXTRA_CA_CERTS "/root/yarnpkg.pem"
ENV OPENSSL_CONF="/root/openssl.cnf"

COPY docker/nginx/etc/nginx/* /etc/nginx/
COPY docker/nginx/openssl.cnf /root/openssl.cnf
COPY docker/nginx/yarnpkg.pem /root/yarnpkg.pem

#COPY certs/* /usr/local/share/ca-certificates/

RUN apt-get update && \
    apt-get install apt-utils openssl ca-certificates curl gnupg apt-transport-https libpng-dev gcc make g++ gettext-base -y && \
    update-ca-certificates

RUN mkdir /etc/nginx/logs
RUN touch /etc/nginx/logs/static.log

RUN mkdir /tmp/nginx

#Setup App Directories
RUN rm -f /etc/nginx/conf.d/*
ADD docker/nginx/etc/nginx/conf.d/* /etc/nginx/conf.d

#Install NPM
RUN curl -fsL http://deb.nodesource.com/setup_18.x | bash - && \
    apt-get update &&\
    apt-get install -y nodejs

#Yarn Install
#RUN npm config set registry "http://registry.npmjs.org" &&\
#    npm install -g yarn &&\
#    yarn config set "strict-ssl" false

WORKDIR /var/www/

COPY docker/nginx/setup.sh /setup.sh

RUN chmod +x /setup.sh

EXPOSE 80 443

ENTRYPOINT ["/setup.sh"]

CMD ["nginx", "-g", "daemon off;"]

########### Testing ###########
FROM base as dev

########## Production ##########
FROM base as prod

#Set to Production Mode
#ENV IS_PRODUCTION 1

#Copy the applcation over
COPY ./ $APP_ROOT

#RUN yarn install --frozen-lockfile && yarn run prod
#RUN yarn install --frozen-lockfile && yarn run dev
#RUN npm install && npm run prod
#RUN npm install && npm run dev
