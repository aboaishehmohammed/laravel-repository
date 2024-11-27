
# Laravel Repository Package

A powerful package for generating repositories and services in Laravel applications. It simplifies the implementation of the repository pattern, promoting clean architecture and separation of concerns.

---

## **Features**

- Create repositories that adhere to a common contract.
- Automatically inject models into repositories.
- Optionally generate corresponding services for repositories.
- Compatible with all Laravel versions from 5.x to 10.x and beyond.

---

## **Installation**

### **1. Require the Package**

Install the package using Composer:

```bash
composer require aboaisheh/laravel-repository
```

---

## **Usage**

### **1. Generate a Repository**

To generate a new repository, use the Artisan command:

```bash
php artisan make:repository ModelName
```

For example:
```bash
php artisan make:repository User
```

This command creates:
- **Repository**: `app/Repositories/UserRepository.php`

To also generate a service along with the repository, use the `--service` flag:
```bash
php artisan make:repository User --service
```

This will create:
- **Repository**: `app/Repositories/UserRepository.php`
- **Service**: `app/Services/UserService.php`

---

### **2. Repository Example**

#### Generated Repository (`UserRepository.php`):

```php
<?php

namespace App\Repositories;

use App\Models\User;
use Aboaisheh\LaravelRepository\Contracts\RepositoryContract;

class UserRepository implements RepositoryContract
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->user->findOrFail($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        $record = $this->user->findOrFail($id);
        return $record->delete();
    }
}
```

---

### **3. Using Repositories in Controllers**

Inject the repository or service into your controllers:

#### Example Controller:

```php
namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()->json($this->userRepository->all());
    }

    public function show($id)
    {
        return response()->json($this->userRepository->find($id));
    }

    public function store(Request $request)
    {
        return response()->json($this->userRepository->create($request->all()));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->userRepository->update($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->userRepository->delete($id));
    }
}
```

---

## **Customization**

You can now generate only the repository or both the repository and service, depending on your requirements.

### **Generate Repository Only**
```bash
php artisan make:repository ModelName
```

### **Generate Repository with Service**
```bash
php artisan make:repository ModelName --service
```

This flexibility allows you to use only what you need, keeping your project clean and efficient.

---

## **License**

This package is open-sourced software licensed under the [MIT License](LICENSE).
