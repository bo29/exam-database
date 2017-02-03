#!/usr/bin/env python
import sys
def addTwo(a):
	c=a+2
	return c
a=sys.argv[1]
c=addTwo(int(a))
print c