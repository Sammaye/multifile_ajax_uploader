# Upload Directory

This is where you would put files after upload.

It is recommended to put this directory outside of your `webroot` and make it so that it can be accessed by `www-data` like so:

`chown www-data /uploads`
`chmod /uploads 0777`

Something similar to the commands above will give you the desired effect.

