#!/bin/bash
find cache/ -name "*.json" -type f -mtime +2 -delete
