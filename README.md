Restful Player
===

A symfony project utilizing nothing

Simple Restful music player

## Running

You can run the Docker environment using [docker-compose](https://docs.docker.com/compose/):

    $ docker-compose -f docker/docker-compose.yml build
    $ docker-compose -f docker/docker-compose.yml up -d
    $ docker-compose -f docker/docker-compose.yml run php mysql -h db mydb -u root --password=root -v < app/sql/rollout.sql
    $ echo '127.0.0.1 deezer.dev' >> /etc/hosts

You can try it in your browser : `deezer.dev/favorite`

A simple API client is available here : `deezer.dev/test.html`

Playlist refresh is available here : `deezer.dev/refreshx.html`

