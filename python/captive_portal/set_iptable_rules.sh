#!/bin/sh

echo "Flushing iptables rules... " + $1

sudo sh reset_iptables.sh 

#sudo ifconfig $1 192.168.0.100 netmask 255.255.255.0
#echo "setting static ip to " $1
#sudo ifconfig $1 down
#echo "upando serviço..."
#sudo ifconfig $1 up 
echo "Configurando redirecionamentos..."
sudo iptables -A POSTROUTING -t nat -o $1 -j MASQUERADE
echo "."
sudo iptables -t mangle -N internet #cria a chain internet
echo "."
sudo iptables -t mangle -A PREROUTING -i $1 -p tcp -m tcp --dport 80 -j internet #redireciona o trafico para a chain internet
echo "."
#sudo iptables -t mangle -A PREROUTING -i $1 -p tcp -m tcp --dport 443 -j internet #redireciona o trafico para a chain internet
echo "."
sudo iptables -t mangle -A internet -j MARK --set-mark 99
echo "."
sudo iptables -t nat -A PREROUTING -i $1 -p tcp -m mark --mark 99 -m tcp --dport 80 -j DNAT --to-destination 10.42.0.1:8000
echo "."
#sudo iptables -t nat -A PREROUTING -i $1 -p tcp -m mark --mark 99 -m tcp --dport 443 -j DNAT --to-destination 127.0.0.1

echo "Done"
