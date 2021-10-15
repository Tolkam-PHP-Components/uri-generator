# tolkam/uri-generator

Generates resource identifiers using different generation strategies.

## Documentation

The code is rather self-explanatory and API is intended to be as simple as possible. Please, read the sources/Docblock if you have any questions. See [Usage](#usage) for quick start.

## Usage

````php
use Tolkam\UriGenerator\Strategy\FilenamePartitionStrategy;
use Tolkam\UriGenerator\Strategy\PathPrefixStrategy;
use Tolkam\UriGenerator\UriGenerator;

$pathPrefixStrategy = new PathPrefixStrategy('//example.com/');

$filenamePartitionStrategy = new FilenamePartitionStrategy([
    'prefix' => '//example.com/',
]);

$uriGenerator = new UriGenerator;
$uriGenerator->addStrategy($pathPrefixStrategy, 'strategy_A');
$uriGenerator->addStrategy($filenamePartitionStrategy, 'strategy_B');

$fileName = 'myFileName.pdf';

echo $uriGenerator->generate($fileName) . PHP_EOL
    . $uriGenerator->generate($fileName, 'strategy_A') . PHP_EOL
    . $uriGenerator->generate($fileName, 'strategy_B');

````

## License

Proprietary / Unlicensed 🤷
