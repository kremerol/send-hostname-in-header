SHELL=bash

default: package

check:
	@which zip > /dev/null || (echo "zip utility must be in your path." && exit 1)
	mkdir -p releases

package: check
	zip releases/send-hostname-in-header.v0.0.1.zip LICENSE *.php
