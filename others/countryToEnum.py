#! /usr/bin/env python2.7

enum = ""

with open('clist', 'r') as f:
    line = f.readline()

    while '' != line:

        line = line[:-2]
        code = line[line.find(';') + 1:]

        enum += "'" + code + "', "

        #print '<' + line + '>'

        line = f.readline()

print enum
