#!/bin/bash

# 配列で抹消ファイルをセット
TARGETS=(
	"sql/2017-11-07.sql"
	"sql/2017-11-07.zip.tmp"
	"2017-10-10.sql"
	"sql/2017-11-01.sql"
	"assets/img/everest.jpg"
	"sql/2017-11-06.sql"
)

# 半角スペースでjoinする
target=$(printf " %s" "${TARGETS[@]}")
target=${target:1}

# 指定したファイルの履歴を抹消する
git filter-branch --index-filter "git rm -r --cached --ignore-unmatch ${target}" -- --all
