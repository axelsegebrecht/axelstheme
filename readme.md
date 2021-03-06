Welcome to Axel's theme. The official Wordpress look-n-feel ready for 2016 to kick off in style and using the latest advances in digital technologies and best practises.

We are using Furtive by John Otander, Google's AMP Project and Wordpress. Our aim is to provide a mobile-first, minimalist and reading optimised website that loads fast.

Our development environment uses GIT and docker on a Mac.

Repositories:
- https://github.com/axelsegebrecht/axelstheme (this place)
- https://github.com/johnotander/furtive 
- https://github.com/ampproject

Docker images:
- https://hub.docker.com/_/wordpress/
- https://hub.docker.com/_/mysql/

On our local dev machine (MacBook Pro running Yosemite), we run the latest docker toolbox and the official WP and MySQL containers.

We downloaded a current version of WP to our dev machine and added our theme to wp-content. We amend the wp-config.php to match our dev mysql set-up (wordpress/password) and then hook-up the local directory to the WP container. Effectively all files are run from our local machine and only MySQL and Apache2 will be running in the containers.

Our .gitignore, courtesey of WPEngine.com, disallows any core files from being managed or pushed across as we will only want our theme files and other customisations.

We can then push to staging or live on WPEngine.com whilst working locally with our install. Note that the database is not transferred! If you need demo data, do a WP export and import to dev and staging. We are concerned with plugs and themes only.

Note that plugs may need db updates, that perhaps should be run after deployment to live or staging to update the db there.