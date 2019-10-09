#!/usr/local/bin/bash

declare -A DNS=( \
[cloudflare1]='1.1.1.1' [cloudflare2]='1.0.0.1' [opendns1]='208.67.222.222' \
[opendns2]='208.67.220.220' [google1]='8.8.8.8' [google2]='8.8.4.4' \
[googlealt1]='208.67.222.222' [googlealt2]='208.67.220.220' [Verisign]='64.6.64.6' \
[IBM_Quad_9]='9.9.9.9' [Norton]='199.85.126.10' [Google_2]='199.85.127.10' \
[Seattle]='66.93.87.2' [Dallas]='64.81.127.2' [Washington_DC]='66.92.159.2' \
[Quebec_Canada]='50.21.174.18' \
)

for K in "${!DNS[@]}" 
do 
  echo -n "$K: "; dig +short $1 @${DNS[$K]}
done
