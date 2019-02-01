#!/bin/bash
echo -n "💩 Cloudflare-1: ";dig +short $1 @1.1.1.1
echo -n "💩 Cloudflare-2: ";dig +short $1 @1.0.0.1
echo -n "💩 OpenDNS-1: ";dig +short $1 @208.67.222.222
echo -n "💩 OpenDNS-2: ";dig +short $1 @208.67.220.220
echo -n "💩 Google-1: ";dig +short $1 @8.8.8.8
echo -n "💩 Google-2: ";dig +short $1 @8.8.4.4
echo -n "💩 Google-alt: ";dig +short $1 @208.67.222.222
echo -n "💩 Google-alt: ";dig +short $1 @208.67.220.220
echo -n "💩 IBM Quad 9: ";dig +short $1 @9.9.9.9
echo -n "💩 Norton: ";dig +short $1 @199.85.126.10
echo -n "💩 Google-2: ";dig +short $1 @199.85.127.10
echo -n "💩 Seattle, WA: "; dig +short $1 @66.93.87.2
echo -n "💩 Dallas, TX: ";dig +short $1 @64.81.127.2
echo -n "💩 Washington, D.C.: ";dig +short $1 @66.92.159.2
echo -n "💩 Quebec, Canada: ";dig +short $1 @50.21.174.18
