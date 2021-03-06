# Url Shortner

Without using an external database, we'd like you to create a URL shortening service.

There should be an endpoint that responds to POST with a json body containing a URL, which responds with a JSON repsonse of the short url and the orignal URL, as in the following curl example:

```
curl localhost -XPOST -d '{ "url": "http://www.payasugym.com" }'
{ "short_url": "/abc123", "url": "http://www.payasugym.com" }
```

When you send a GET request to a previously returned URL, it should redirect to the POSTed URL, as shown in the following curl example:

```
curl -v localhost/abc123
...
< HTTP/1.1 301 Moved Permanently
...
< Location: http://www.payasugym.com
...
{ "url": "http://www.payasugym.com" }
```

On the frontend we would like you to use React, there should be an input field and submit button on the page into which the URL you would like to shorten can be entered and the short url should be returned

To start you off on the frontend we have created a hello world example, which you can use as the basis for the React Frontend.
To start off, clone the repository and create a new branch.

To install the node modules run:

```
npm install
```

To create the JS bundle and run the watcher run:

```
npm run watch
```

You can use whatever npm modules and PHP framework you are comfortable with.

For extra points: Style the frontend with Sass

Please don't spend more than a few hours on this.

## Deploy

> You need to install docker and docker-compose for the automated builds
> Install docker: https://docs.docker.com/install/
> Install docker-compose: https://docs.docker.com/compose/install/

```bash
# Install composer dependencies
composer install

# Install javascript dependencies
npm install

# Build javascript files
npm run build

# Bootstrap server
docker-compose up -d

# Type in your browser
localhost:8000
```
