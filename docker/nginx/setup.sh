#!/usr/bin/env sh
set -eu

envsubst '${NGINIX_UPSTREAM_SERVER} ${NGINIX_UPSTREAM_SERVER_PORT}' </etc/nginx/nginx.conf.default >/etc/nginx/nginx.conf

if [ "$IS_PRODUCTION" -eq 0 ]; then
  cp /etc/nginx/fastcgi_params.default /etc/nginx/fastcgi_params
else
  cp /etc/nginx/fastcgi_params.default-prod /etc/nginx/fastcgi_params
fi

envsubst '${NGINIX_LISTEN_PORT} ${NGINIX_SERVER_NAME} ${NGINIX_ROOT}' </etc/nginx/conf.d/app.site.conf.default >/etc/nginx/conf.d/app.site.conf

exec "$@"
