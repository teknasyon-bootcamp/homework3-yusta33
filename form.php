<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */
class Form
{   //Sinif ozellikleri tanimlamalari//
    private string $action;
    private string $method;
    public array $fields = [];

    private function __construct(string $action,string $method)
    {//Action ve method degerleri atamasi.//
        $this->action = $action;
        $this->method = $method;
    }
    //Istenen static formlari//
    public static function createForm(string $action,string $method): Form
    {
        return new static($action,$method);
    }
    public static function createGetForm(string $action): Form
    {
        return new static($action,"GET");
    }
    public static function createPostForm(string $action): Form
    {
        return new static($action,"POST");
    }
    public function addField(string $label,string $name,?string $defaultValue = null): void
    {//Degerler diziye eklendi//
        $this->fields[$name]=
        [
            "label"=> $label,
            "name"=> $name,
            "defaultValue"=>$defaultValue 
        ];
    }
    public function setMethod(string $method): void
    {   //Method set edildi//
        $this->method=$method;
    }
    public function render(): void
    {
        //Html ciktisi//
        echo "<form method='$this->method' action='$this->action'>";
      
        foreach ($this->fields as $field) 
        {// Dizi oldugu icin foreach dongusu kullanildi//
            echo "<label for='$field[name]'>$field[label] </label>" . PHP_EOL;
            echo "<input type='text' name='$field[name]' value='$field[defaultValue]'/>";
        }
        echo "<button type='submit'>Gönder</button>";
        echo "</form>";
    }
}
