#! /bin/sh

find . -name '*.php' -exec sed -ie '$ a\/* vim: set ts=4 sw=4 tw=80 sts=4 fdm=marker nowrap et :*/' {} \;
