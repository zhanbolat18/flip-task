# Конвертер CSV в XML

    Конвертер работает в режиме CLI. На вход дается CSV файл с форматом

    Код;Цена
    345-HG;300
    678-BD;200
    GF3940;500
    
    На выходной поток отправляется XML содержимое в формате
    
    <items>
        <item>
            <code>HG-345</code>
            <price>1050</price>
        </item>
        <item>
            ...
        </item>
    </items>
   
Для запуска выполните установку зависимости через composer, а затем вызовите команду 

```shell
./run.php convert "Имя/Путь к CSV файлу" > "Имя/Путь к выходному файлу"
```

Например
```shell
./run.php convert ./Untitled\ 1.csv > a.xml
```