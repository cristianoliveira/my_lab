# NetworkHelper.py

import os, sys

class NetworkHelper(object):
    def get_mac_from_ip(self, p_ip):
    	print "get_mac_from_ip"
        remote_mac   = "NULL"
        remote_arp   = os.popen("sudo /usr/sbin/arp -an %s " % p_ip )
        print "remote_arp %s" % remote_arp
        try:
            pregmatch    = re.search(r'([0-9A-F]{2}[:-]){5}([0-9A-F]{2})', remote_arp, re.I).group()
            remote_mac   = pregmatch[0]
        except:
            pass

        return remote_mac
