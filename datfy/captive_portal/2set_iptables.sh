#!/bin/sh

iptables -t nat -A PREROUTING -i $1 -p tcp --dport 80 -j DNAT  --to-destination  10.42.0.1:8000
iptables -t nat -A PREROUTING -i $1 -p tcp --dport 430 -j DNAT --to-destination  10.42.0.1:8000
#iptables -t nat -A PREROUTING -i $1 -p tcp --dport 443 -j DNAT --to-destination  10.42.0.1:8000
iptables -t nat -A POSTROUTING -j MASQUERADE
