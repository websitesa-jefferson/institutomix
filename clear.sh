#!/bin/bash

chown 1000:1000 -R vendor
chown 1000:1000 -R composer.lock
rm -rf institutomix/web/assets/*
rm -rf institutomix/runtime/cache/*
rm -rf institutomix/runtime/debug/*
rm -rf institutomix/runtime/logs/*
rm -rf institutomix/runtime/mpdf/*
rm -rf institutomix/runtime/mail/*
rm -rf institutomix/console/runtime/logs/*
chmod 777 -R institutomix/web
chmod 777 -R institutomix/web/assets
chmod 777 -R institutomix/runtime
chmod 777 -R institutomix/modules
chmod 777 -R institutomix/migrations
chmod 777 -R institutomix/config
chmod 777 -R institutomix/console
