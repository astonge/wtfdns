#!/usr/bin/env bash
#!/usr/local/bin/bash

if [ -z $1 ]
then
  echo "error: supply hostname (eg: $0 <hostname.tld>"
  exit 1
fi

declare -A DNS=( \
[cloudflare1]='1.1.1.1' \
[cloudflare2]='1.0.0.1' \
[opendns1]='208.67.222.222' \
[opendns2]='208.67.220.220' \
[google1]='8.8.8.8' \
[google2]='8.8.4.4' \
[googlealt1]='208.67.222.222' \
[googlealt2]='208.67.220.220' \
[verisign]='64.6.64.6' \
[ibm_quad_9]='9.9.9.9' \
[norton]='199.85.126.10' \
[google_2]='199.85.127.10' \
[seattle]='66.93.87.2' \
[dallas]='64.81.127.2' \
[washington_dc]='66.92.159.2' \
[quebec_canada]='50.21.174.18' \
)

for K in "${!DNS[@]}" 
do
  ip=$(dig +timeout=1 +short $1 @${DNS[$K]}|grep -oE "\b([0-9]{1,3}\.){3}[0-9]{1,3}\b")
  if [ ! -z $ip ]
  then
    echo "$K:$ip"
  else
    echo "$K:error."
  fi
done
