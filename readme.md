# CSVTranslator

A simple PHP CSV reader.

```php
use CSVTranslator\CSVTranslator as CSV;

$file = CSV::getContent('path/to/file.csv');

// Process the content
// Or even can parse the content with table names.

$table = CSV::getContentWithKeys('path/to/file.csv', array(
  'column-name1',
  'column-name2',
      ));

$records = $table['data'];

// if the file have errors (incomplete data; count($keys) !== count($row))
$errors = $table['errors'];

// parse the $records to your ORM to populate DB.
```
