
## to run please check https://github.com/tutumcloud/tutum-docker-php

docker build -t tutum/apache-php .

docker run -d -p 80:80 tutum/apache-php
