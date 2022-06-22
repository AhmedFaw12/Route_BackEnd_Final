<?php 
/*
-->trait:
PHP only supports single inheritance: a child class can inherit only from one single parent.

So, what if a class needs to inherit multiple behaviors? OOP traits solve this problem.

Traits are used to declare methods, properties that can be used in multiple classes. Traits can have methods and abstract methods that can be used in multiple classes, and the methods can have any access modifier (public, private, or protected).

-trait is same as class , but it is not used alone , it is used inside another class

Traits are declared with the trait keyword:
example :
trait TraitName {
  // some code...
}

-To use a trait in a class, use the use keyword:
class MyClass {
  use TraitName;
}

-A trait is similar to a class, but it is only for grouping methods

-PHP does not allow you to create an instance of a Trait 

example on Using Multiple Traits:
trait message1 {
  public function msg1() {
    echo "OOP is fun! ";
  }
}

trait message2 {
  public function msg2() {
    echo "OOP reduces code duplication!";
  }
}

class Welcome {
  use message1;
}

class Welcome2 {
  use message1, message2;
}

$obj = new Welcome();
$obj->msg1();
echo "<br>";

$obj2 = new Welcome2();
$obj2->msg1();
$obj2->msg2();
//////////////////////////////////////////////////////////////
-->Composing multiple traits:

    -PHP allows you to compose multiple traits into a trait by using the use statement in the trait’s declaration.


-->Overriding trait method
        -When a class uses multiple traits that share the same method name, PHP will raise a fatal error. 
        
        -Fortunately, you can instruct PHP to use the method by using the inteadof keyword

--Aliasing trait method:
    -By using aliases for the same method name of multiple traits, you can reuse all the methods in those traits.

    -You use the as keyword to alias a method of a trait to a different name within the class that uses the trait.
*/

//example on Composing multiple traits
//PHP allows you to compose multiple traits into a trait by using the use statement in the trait’s declaration. For example:
trait Reader
{
	public function read($source)
	{
		echo sprintf('Read from %s <br>', $source);
	}
}

trait Writer
{
	public function write($destination)
	{
		echo sprintf('Write to %s <br>', $destination);
	}
}

trait Copier
{
	use Reader, Writer;

	public function copy($source, $destination)
	{
		$this->read($source);
		$this->write($destination);
	}
}

class FileUtil
{
	use Copier;

	public function copyFile($source, $destination)
	{
		$this->copy($source, $destination);
	}
}

$f = new FileUtil();
$f->copy("location1", "location2");
//////////////////////////////////////////////////////////////

//example on Overriding trait method
//When a class uses multiple traits that share the same method name, PHP will raise a fatal error. 

//Fortunately, you can instruct PHP to use the method by using the insteadof keyword

trait FileLogger
{
	public function log($msg)
	{
		echo 'File Logger ' . date('Y-m-d h:i:s') . ':' . $msg . '<br/>';
	}
}

trait DatabaseLogger
{
	public function log($msg)
	{
		echo 'Database Logger ' . date('Y-m-d h:i:s') . ':' . $msg . '<br/>';
	}
}

class Logger
{
	use FileLogger, DatabaseLogger{
		FileLogger::log insteadof DatabaseLogger;
	}
}

$logger = new Logger();
$logger->log('this is a test message #1');
$logger->log('this is a test message #2');

////////////////////////////////////////////////////////////////Aliasing trait method:
//By using aliases for the same method name of multiple traits, you can reuse all the methods in those traits.
//You use the as keyword to alias a method of a trait to a different name within the class that uses the trait.

class Logger2
{
	use FileLogger, DatabaseLogger{
		DatabaseLogger::log as logToDatabase;
		FileLogger::log insteadof DatabaseLogger;
	}
}

$logger2 = new Logger2();
$logger2->log('this is a test message #1');
$logger2->logToDatabase('this is a test message #2');