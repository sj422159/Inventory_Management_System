{ pkgs, stdenv, lib }:

{
  # Define dependencies
  dependencies = {
    runtime = [ pkgs.php82 ];
    build = [];
    dev = [];
  };

  # Setup environment variables
  env = {
    PATH = "/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin";
    APP_ENV = "production";
  };

  # Build phase
  buildPhase = ''
    echo "Installing Composer dependencies"
    composer install --optimize-autoloader --no-dev
  '';

  # Install phase
  installPhase = ''
    echo "Setting up Laravel app..."
    cp -r . $out/www
  '';
}