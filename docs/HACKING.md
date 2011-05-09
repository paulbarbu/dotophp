Development mailing list
========================
Go to: [dotophp mailing list](http://groups.google.com/group/dotophp)

Coding standards
================
We've settled to [THESE](http://framework.zend.com/manual/en/coding-standard.overview.html)
coding standards 

Code documentation standards
=======================
According to our coding standards:
> All documentation blocks ("docblocks") must be compatible with the 
[phpDocumentor](http://phpdoc.org/) format.

Function names
==============
Function names will be prefixed with: 

* User related functions: __user__
* Category related functions: __cat__
* Events related functions: __ev__
* Plugins functions: __plg__
* ACP functions: __acp__

And according to our coding standards the following letter will be capital.
> _i.e.:_ catNew(), evDel()

General rules
=============
* all documentation files should use Markdown syntax

Committing changes
==================
* commit messages will be prefixed with these _tags_: 
	* __[DOC]__ for documentation changes
	* __[FIX]__ for code fixes
	* __[FILE]__ for files/directories structure changes


Example: _[FILE] added docs/HACKING.md_
