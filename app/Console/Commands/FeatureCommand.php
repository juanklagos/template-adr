<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FeatureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:feature {domain : Class (singular) for example User} {name : Class (singular) for example Customer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a feature from scratch in ADR format';

    protected $items = [
        'Entity' => [
            'suffix' => '',
            'path' => 'src/{{domainName}}/Domain/Entities',
        ],
        'Policy' => [
            'suffix' => 'Policy',
            'path' => 'src/{{domainName}}/Domain/Entities/Policies',
        ],
        'Resource' => [
            'suffix' => 'Resource',
            'path' => 'src/{{domainName}}/Domain/Resources',
        ],
        'SchemaList' => [
            'suffix' => 'List',
            'path' => 'src/{{domainName}}/Domain/Schemas',
        ],
        'Validator' => [
            'suffix' => 'Validator',
            'path' => 'src/{{domainName}}/Domain/Validators',
        ],
        'RepositoryInterface' => [
            'suffix' => 'Repository',
            'path' => 'src/{{domainName}}/Domain/Interfaces/Repositories',
        ],
        'Repository' => [
            'suffix' => 'RepositoryEloquent',
            'path' => 'src/{{domainName}}/Domain/Repositories',
        ],
        'DestroyAction' => [
            'suffix' => 'DestroyAction',
            'path' => 'src/{{domainName}}/Action/{{modelName}}',
        ],
        'DestroyService' => [
            'suffix' => 'DestroyService',
            'path' => 'src/{{domainName}}/Domain/Services/{{modelName}}',
        ],
        'DestroyResponder' => [
            'suffix' => 'DestroyResponder',
            'path' => 'src/{{domainName}}/Responder/{{modelName}}',
        ],
        'ListAction' => [
            'suffix' => 'ListAction',
            'path' => 'src/{{domainName}}/Action/{{modelName}}',
        ],
        'ListService' => [
            'suffix' => 'ListService',
            'path' => 'src/{{domainName}}/Domain/Services/{{modelName}}',
        ],
        'ListResponder' => [
            'suffix' => 'ListResponder',
            'path' => 'src/{{domainName}}/Responder/{{modelName}}',
        ],
        'StoreAction' => [
            'suffix' => 'StoreAction',
            'path' => 'src/{{domainName}}/Action/{{modelName}}',
        ],
        'StoreService' => [
            'suffix' => 'StoreService',
            'path' => 'src/{{domainName}}/Domain/Services/{{modelName}}',
        ],
        'StoreResponder' => [
            'suffix' => 'StoreResponder',
            'path' => 'src/{{domainName}}/Responder/{{modelName}}',
        ],
        'UpdateAction' => [
            'suffix' => 'UpdateAction',
            'path' => 'src/{{domainName}}/Action/{{modelName}}',
        ],
        'UpdateService' => [
            'suffix' => 'UpdateService',
            'path' => 'src/{{domainName}}/Domain/Services/{{modelName}}',
        ],
        'UpdateResponder' => [
            'suffix' => 'UpdateResponder',
            'path' => 'src/{{domainName}}/Responder/{{modelName}}',
        ],
        'ViewAction' => [
            'suffix' => 'ViewAction',
            'path' => 'src/{{domainName}}/Action/{{modelName}}',
        ],
        'ViewService' => [
            'suffix' => 'ViewService',
            'path' => 'src/{{domainName}}/Domain/Services/{{modelName}}',
        ],
        'ViewResponder' => [
            'suffix' => 'ViewResponder',
            'path' => 'src/{{domainName}}/Responder/{{modelName}}',
        ],
    ];

    protected $replaceHeader = '/*HEADER*/';
    protected $replaceBody = '/*BODY*/';

    protected $appendLines = [
        'Routes' => [
            'sections' => ['Header', 'Body'],
            'file' => 'routes/api.php',
        ],
        'RepositoryServiceProvider' => [
            'sections' => ['Header', 'Body'],
            'file' => 'app/Providers/RepositoryServiceProvider.php',
        ],
        'Permission' => [
            'sections' => ['Body'],
            'file' => 'app/Permission.php',
        ],
        'PermissionTableSeeder' => [
            'sections' => ['Body'],
            'file' => 'database/seeds/PermissionsTableSeeder.php',
        ],
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        foreach ($this->items as $type => $path) {
            $this->generate($type, $name);
            $this->info($type);
        }

        foreach ($this->appendLines as $type => $line) {
            foreach ($line['sections'] as $section) {
                $this->appendLine($line['file'], $type, $section);
                $this->info($type . $section);
            }
        }

        $table = Str::snake(Str::plural($name));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--path' => 'database/migrations',
        ]);

        return 0;
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/{$type}.stub"));
    }

    protected function generate($type, $name)
    {
        $values = $this->getReplaceValues();
        $template = str_replace($values['search'], $values['replace'], $this->getStub($type));
        $path = str_replace($values['search'], $values['replace'], base_path($this->items[$type]['path']));

        $filename = "{$name}{$this->items[$type]['suffix']}.php";

        $this->checkDirectory($path);
        $this->saveTemplate("{$path}/{$filename}", $template);
    }

    private function checkDirectory(string $path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    private function saveTemplate($location, $template)
    {
        file_put_contents($location, $template);
    }

    private function appendLine($file, $type, $section)
    {
        $fileTemplate = File::get(base_path($file));
        $placeholder = $section === 'Header' ? $this->replaceHeader : $this->replaceBody;
        $stub = $this->getStub($type . $section);

        $values = $this->getReplaceValues();
        $template = str_replace($values['search'], $values['replace'], $stub);

        File::put(base_path($file), str_replace($placeholder, $template, $fileTemplate));
    }

    private function getReplaceValues()
    {
        $domain = $this->argument('domain');
        $name = $this->argument('name');

        $modelSingular = Str::singular($name);
        $modelPlural = Str::plural($name);
        $modelPluralUpperCase = Str::upper($modelPlural);
        $modelSingularSnake = Str::snake($modelSingular);
        $modelPluralSnake = Str::snake($modelPlural);
        $modelPluralSlug = Str::slug($modelPluralSnake);
        $modelSingularCamel = Str::camel($name);
        $modelPluralCamel = Str::camel($modelPlural);
        $modelPluralSnakeUpperCase = Str::upper($modelPluralSnake);

        return [
            'search' => [
                '{{domainName}}',
                '{{modelName}}',
                '{{modelPlural}}',
                '{{modelPluralUpperCase}}',
                '{{modelSingularSnake}}',
                '{{modelPluralSnake}}',
                '{{modelPluralSlug}}',
                '{{modelSingularCamel}}',
                '{{modelPluralCamel}}',
                '{{modelPluralSnakeUpperCase}}',
            ],
            'replace' => [
                $domain,
                $modelSingular,
                $modelPlural,
                $modelPluralUpperCase,
                $modelSingularSnake,
                $modelPluralSnake,
                $modelPluralSlug,
                $modelSingularCamel,
                $modelPluralCamel,
                $modelPluralSnakeUpperCase,
            ],
        ];
    }
}
