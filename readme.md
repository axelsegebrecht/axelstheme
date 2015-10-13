Welcome to Axel's theme. The official Wordpress look-n-feel ready for 2016 to kick off in style and using the latest advances in digital technologies and best practises.

We are using Furtive by John Otander, Googl's AMP Project and Wordpress. Our aim is to provide a mobile-first, minimalist reading optimised website that is providing a fab user experience.

Our development environment uses GIT and docker on a Mac.

Repositories:
axelstheme.git -> github public repo for your viewing pleasure
https://github.com/johnotander/furtive
https://github.com/ampproject

Docker images:
https://hub.docker.com/_/wordpress/
https://hub.docker.com/_/mysql/

On our local dev machine (MacBook Pro running Yosemite), we run the latest docker toolbox and the official WP and MySQL containers.

We downloaded a current version of WP to our dev machine and added our theme to wp-content. We amend the wp-config.php to match our dev mysql set-up (wordpress/password) and then hook-up the local directory to the WP container. Effectively all files are run from our local machine and only MySQL and Apache2 will be running in the containers.

Our .gitignore, courtesey of WPEngine.com, disallows any core files from being managed or pushed across as we will only want our theme files and other customisations.
