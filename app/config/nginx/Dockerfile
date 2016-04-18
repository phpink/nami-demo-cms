FROM nginx:1.9.3


COPY nginx.conf /etc/nginx/
COPY nami.conf /etc/nginx/sites-available/

RUN mkdir /etc/nginx/sites-enabled \
    && rm /etc/nginx/conf.d/default.conf \
    && ln -s /etc/nginx/sites-available/nami.conf /etc/nginx/sites-enabled/nami


