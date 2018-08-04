# EventableFlysystemBundle

This bundle integrates the [eventable-flysystem](https://github.com/frositeDE/eventable-flysystem)
with Symfony (3 and 4).

# Installation

    $ composer require frostiede/eventable-flysystem-bundle
    
# Configuration

Add the following config:

    eventable_flysystem:
        filesystems:
            - oneup_flysystem.your_filesystem
            - oneup_flysystem.another_filesystem
        event_dispatcher: 'event_dispatcher'
        
You may add filesystems which are configured on the OneupFlysystemBundle by their id. The filesystems are converted
to an instance of `EventableFilesystem` by this bundle.

If you use the default `EventDispatcher` you may not specify `event_dispatcher`. Otherwise, you need to put
the Id of the `EventDispatcher` instance you want to use with the `EventableFilesystem` into the `event_dispatcher` key.

# Usage

Just use the filesystem as you would do only with the OneupFlysystemBundle. But in addition, you can subscribe to any
events the `EventableFilesystem` may dispatch.

# Contribute

Feel free to contribute :-)

# License

MIT