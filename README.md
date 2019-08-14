# Contao css utils bundle
Bundle to create css classes from contao backend

## align-content
```
.ac(-[$breakpont])-[flex-start|flex-end|center|space-between|space-around|stretch]
```

## align-items
```
.ai(-[$breakpont])-[stretch|flex-start|flex-end|center|baseline]
```

## background-color
```
.bg(-[$breakpont])-[$name]
```

## color
```
.c(-[$breakpont])-[$name](-hover)
```

## columns
```
.col(-[$breakpont])-[$columns]
```

## display
```
.d(-[$breakpont])-[none|inline|block|inline-block|flex|inline-flex|table|table-row|table-cell]
```

## flex-direction
```
.fd(-[$breakpont])-[row|row-reverse|column|column-reverse]
```

## flex-wrap
```
.fw(-[$breakpont])-[nowrap|wrap|wrap-reverse]
```

## font-family
```
.font-[$name]
```

## height
```
.h(-[$breakpont])-[auto|full|$height]
```
$height = round(height * 10)

## justify-content
```
.jc(-[$breakpont])-[flex-start|flex-end|center|space-between|space-around|space-evenly]
```

## margin
```
.m([t|r|b|l|y|x])(-[$breakpont])-[$margin]
```
$margin = round(margin * 10)

## offset
```
.offset(-[$breakpont])-[$columns]
```

## padding
```
.p([t|r|b|l|y|x])(-[$breakpont])-[$padding]
```
$padding = round(margin * 10)

## position
```
.position(-[$breakpont])-[static|relative|absolute|sticky|fixed]
```

## text-decoration
```
.td-[underline|overline|line-through|blink|none|inherit](-hover)
```

## width
```
.w(-[$breakpont])-[auto|full|$width]
```
$width = round(width * 10)