#! /usr/bin/env python2.7

options = ""
template = '<option value="%(val)s">%(text)s</option>\n';

with open('clist', 'r') as f:
    line = f.readline()

    while '' != line:

        line = line[:-2]
        pos = line.find(';')
        code = line[pos + 1:]
        name = line[:pos]

        pos = name.find(',')

        if -1 != pos:
            name = name[:pos];


        options += template % {'val': code,
                               'text': name.title()}

        #print '<' + line + '>'

        line = f.readline()

print options
