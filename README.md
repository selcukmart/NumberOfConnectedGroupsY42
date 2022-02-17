```
composer require selcukmart/number-of-connected-groups-y42
```

### Number of connected groups

There are two solutions in it. One of them is non-recursive(custom distance calculation between coordinates technic) only iterable, the other is a classic solution called Depth First Search (DFS) .

The code has unit tests. It can be tested after cloned.
```
tests/CountForIterativeTest.php
tests/CountForRecursiveTest.php
```
Iterative Example;

```php
$matrix = [
[1, 1, 1, 0, 0],
[0, 0, 1, 0, 0],
[0, 0, 0, 1, 1],
[1, 0, 0, 0, 0],
[1, 0, 1, 0, 1]
];

$result = (new NumberOfConnectedGroupsIterative(5, 5))->countGroups($matrix);
```
The result will be 5 for only horizontal and vertical links.

DFS Example
```php
$matrix = [
            [1, 1, 0, 0, 0],
            [0, 1, 0, 0, 1],
            [1, 0, 0, 1, 1],
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 1]
        ];

        $result = (new NumberOfConnectedGroupsRecursive(5, 5))->countGroups($matrix);
```

The result will be 5 for only horizontal and vertical links.