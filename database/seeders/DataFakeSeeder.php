<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\RubricCriterion;
use App\Models\RubricLevel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DataFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //inserta USUARIOS
        DB::table('users')->insert([
            'name' => 'Eliana Galvis',
            'email' => 'fonoeliana22@gmail.com',
            'password' => Hash::make('secret'),
            'phone' => '3229243184',
            'location' => 'Calle 10 # 21-67 apt 602',
            'about_me' => 'Ingeniero de mecanica',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::factory()->count(17)->create();

        // Insertar datos en la tabla rubrics
        DB::statement("
          INSERT INTO public.rubrics (name, description, total_rating, created_at, updated_at) VALUES
          ('Rubrica de evaluación', 'Rubrica para evaluar', 5.0, '2024-03-03 04:55:30', '2024-03-03 04:55:30');
      ");

        // Insertar datos en la tabla rubric_criteria
        DB::statement("
          INSERT INTO public.rubric_criteria (name, rubrics_id, created_at, updated_at) VALUES
          ('Originalidad de la idea central.', 1, '2024-03-03 04:55:50', '2024-03-03 04:55:50'),
          ('Elaboración de las ideas secundarias.', 1, '2024-03-03 04:57:18', '2024-03-03 04:57:18'),
          ('Redacción, cohesión y coherencia.', 1, '2024-03-03 04:58:31', '2024-03-03 04:58:31');
      ");


        // Insertar datos en la tabla rubric_levels
        DB::statement("
          INSERT INTO public.rubric_levels (name, points, rubric_criteria_id, created_at, updated_at) VALUES
          ('Insuficiente. No entrega el trabajo.', 0.0, 1, '2024-03-03 04:56:01', '2024-03-03 04:56:01'),
          ('Bien. La idea central es interesante, pero no es novedosa o podría mejorar', 4.0, 1, '2024-03-03 04:56:32', '2024-03-03 04:56:32'),
          ('Muy bien. La idea central es interesante y novedosa.', 6.0, 1, '2024-03-03 04:56:46', '2024-03-03 04:56:46'),
          ('Excelente. La idea central es muy interesante y muy novedosa.', 8.0, 1, '2024-03-03 04:57:01', '2024-03-03 04:57:01'),
          ('Insuficiente. No entrega el trabajo', 0.0, 2, '2024-03-03 04:57:29', '2024-03-03 04:57:29'),
          ('Bien. Las ideas secundarias se relacionan con la idea central.', 5.0, 2, '2024-03-03 04:57:45', '2024-03-03 04:57:45'),
          ('Excelente. Las ideas secundarias son interesantes y originales y se relacionan con la idea central.', 10.0, 2, '2024-03-03 04:57:59', '2024-03-03 04:57:59'),
          ('Insuficiente. No entrega el trabajo.', 0.0, 3, '2024-03-03 04:58:42', '2024-03-03 04:58:42'),
          ('Excelente. La argumentación, la puntuación, la cohesión y la coherencia se destacan.', 10.0, 3, '2024-03-03 04:58:55', '2024-03-03 04:58:55');
      ");

        // Insertar datos en la tabla rubrics
        DB::statement("
            INSERT INTO public.rubrics (name, description, total_rating, created_at, updated_at) VALUES
            ('Otra rubrica', 'Otra descripción', 6.0, '2024-03-04 05:00:00', '2024-03-04 05:00:00'),
            ('Rubrica de ejemplo', 'Descripción de la rubrica de ejemplo', 7.0, '2024-03-05 06:00:00', '2024-03-05 06:00:00'),
            ('Rubrica 4', 'Descripción de la rubrica 4', 8.0, '2024-03-06 07:00:00', '2024-03-06 07:00:00'),
            ('Rubrica 5', 'Descripción de la rubrica 5', 9.0, '2024-03-07 08:00:00', '2024-03-07 08:00:00');
        ");

        // Obtener las nuevas rubricas
        $rubrics = Rubric::whereIn('name', ['Otra rubrica', 'Rubrica de ejemplo', 'Rubrica 4', 'Rubrica 5'])->get();

        // Asignar criterios y niveles a las nuevas rubricas
        $rubrics->each(function ($rubric) {
            // Insertar datos en la tabla rubric_criteria
            $criterionData = [
                ['name' => 'Criterio 1', 'rubrics_id' => $rubric->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Criterio 2', 'rubrics_id' => $rubric->id, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Criterio 3', 'rubrics_id' => $rubric->id, 'created_at' => now(), 'updated_at' => now()]
            ];
            DB::table('rubric_criteria')->insert($criterionData);

            // Obtener los criterios insertados
            $criteria = RubricCriterion::where('rubrics_id', $rubric->id)->get();

            // Asignar niveles a los criterios
            $criteria->each(function ($criterion) {
                $levelData = [
                    ['name' => 'Nivel 1', 'points' => 1, 'rubric_criteria_id' => $criterion->id, 'created_at' => now(), 'updated_at' => now()],
                    ['name' => 'Nivel 2', 'points' => 2, 'rubric_criteria_id' => $criterion->id, 'created_at' => now(), 'updated_at' => now()],
                    ['name' => 'Nivel 3', 'points' => 3, 'rubric_criteria_id' => $criterion->id, 'created_at' => now(), 'updated_at' => now()]
                ];
                DB::table('rubric_levels')->insert($levelData);
            });
        });


        $faker = Faker::create();

        // Insertar datos en la tabla rubrics
        for ($i = 0; $i < 25; $i++) {
            $rubric = new Rubric();
            $rubric->name = $faker->sentence;
            $rubric->description = $faker->paragraph;
            $rubric->total_rating = $faker->randomFloat(1, 1, 10);
            $rubric->save();

            // Insertar datos en la tabla rubric_criteria
            for ($j = 0; $j < 3; $j++) {
                $criterion = new RubricCriterion();
                $criterion->name = $faker->sentence;
                $criterion->rubrics_id = $rubric->id;
                $criterion->save();

                // Insertar datos en la tabla rubric_levels
                for ($k = 0; $k < 3; $k++) {
                    $level = new RubricLevel();
                    $level->name = $faker->sentence;
                    $level->points = $faker->randomFloat(1, 1, 10);
                    $level->rubric_criteria_id = $criterion->id;
                    $level->save();
                }
            }
        }


        DB::statement("
            INSERT INTO public.events (name, opening_date, closing_date, created_by, description, img_cover, password, state, slug, rubrics_id, created_at, updated_at) VALUES
            ('TECNOLÓGICAS MÓVILES', '2024-03-03 19:18:00', '2024-03-08 19:18:00', 1, 'Las tecnologías móviles son avances tecnológicos diseñados para dispositivos que las personas pueden llevar consigo, como teléfonos inteligentes y tabletas. La tecnología móvil es aquella que va a donde está el usuario. Se compone de dispositivos portátiles de comunicación bidireccional, dispositivos informáticos y la tecnología de red que los conecta. Algunos tipos de dispositivos móviles son: Teléfonos inteligentes y Tabletas Relojes inteligentes Agendas digitales Calculadoras Videoconsolas portátiles Reproductores digitales Cámaras fotográficas digitales Cámaras de video digitales', 'assets/docs-default/moviles.jpg', '1234', 1, 'tecnologicas-moviles', NULL, '2024-03-04 00:19:22', '2024-03-04 00:19:22'),
            ('DESARROLLO DE VIDEOJUEGOS', '2024-03-03 19:20:00', '2024-03-07 19:20:00', 1, 'ESTE ES UN EJEMPLO DE PROYECTO QUE SE DEBERIA HACER PARA ......', 'assets/docs-default/videojuegos.jpg', '1234', 1, 'desarrollo-de-videojuegos', NULL, '2024-03-04 00:20:55', '2024-03-04 00:20:55'),
            ('SEMANA DE LA INGENIERÍA - INNGENIATEC', '2024-03-03 19:15:00', '2024-03-04 19:15:00', 1, 'La Facultad de Ingeniería de la UNAB tiene el gusto de invitarlos a la segunda edición de nuestra Semana de Ingeniería: Ingeniería en la era de la inteligencia artificial: ética, retos y tendencias, a desarrollarse los días 4, 5 y 6 de octubre de 2023. En el evento se reunirán estudiantes, docentes y profesionales para abordar desde distintos campos disciplinares el aporte de la ingeniería a la sociedad. En este espacio, se contará con la presencia de ponentes magistrales, líderes en las temáticas principales del evento. De igual forma, se llevarán a cabo actividades institucionales como lo son el XVII Encuentro de Semilleros de Investigación 2023 UNAB y el INGENIATE-C 2023.', 'assets/docs-default/ingeniatec.jpg', '1234', 1, 'semana-de-la-ingenieria-inngeniatec', NULL, '2024-03-04 00:17:08', '2024-03-04 00:17:08');
        ");

        DB::table('events_has_project_field')->insert([
            ['events_id' => 1, 'project_field_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 2, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 3, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 4, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 5, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 6, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 7, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 8, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 9, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 10, 'created_at' => null, 'updated_at' => null],
        ]);

        DB::table('events_has_project_field')->insert([
            ['events_id' => 1, 'project_field_id' => 11, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 12, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 1, 'project_field_id' => 13, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 2, 'project_field_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 2, 'project_field_id' => 2, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 2, 'project_field_id' => 12, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 2, 'project_field_id' => 13, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 1, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 2, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 3, 'created_at' => null, 'updated_at' => null],
        ]);

        DB::table('events_has_project_field')->insert([
            ['events_id' => 3, 'project_field_id' => 4, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 5, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 6, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 7, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 8, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 9, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 10, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 11, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 12, 'created_at' => null, 'updated_at' => null],
            ['events_id' => 3, 'project_field_id' => 13, 'created_at' => null, 'updated_at' => null],
        ]);


        // Insertar eventos
        DB::statement("
INSERT INTO public.events (name, opening_date, closing_date, created_by, description, img_cover, password, state, slug, rubrics_id, created_at, updated_at) VALUES
('Evento 1', '2024-03-03 19:18:00', '2024-03-08 19:18:00', 1, 'Descripción del evento 1', 'event_images/imagen1.jpg', '1234', 1, 'evento-1', NULL, '2024-03-04 00:19:22', '2024-03-04 00:19:22'),
('Evento 2', '2024-03-03 19:20:00', '2024-03-07 19:20:00', 1, 'Descripción del evento 2', 'event_images/imagen2.jpg', '1234', 1, 'evento-2', NULL, '2024-03-04 00:20:55', '2024-03-04 00:20:55'),
('Evento 3', '2024-03-03 19:15:00', '2024-03-04 19:15:00', 1, 'Descripción del evento 3', 'event_images/imagen3.jpg', '1234', 1, 'evento-3', NULL, '2024-03-04 00:17:08', '2024-03-04 00:17:08'),
('Evento 4', '2024-03-03 19:18:00', '2024-03-08 19:18:00', 1, 'Descripción del evento 4', 'event_images/imagen4.jpg', '1234', 1, 'evento-4', NULL, '2024-03-04 00:19:22', '2024-03-04 00:19:22'),
('Evento 5', '2024-03-03 19:20:00', '2024-03-07 19:20:00', 1, 'Descripción del evento 5', 'event_images/imagen5.jpg', '1234', 1, 'evento-5', NULL, '2024-03-04 00:20:55', '2024-03-04 00:20:55'),
('Evento 6', '2024-03-03 19:15:00', '2024-03-04 19:15:00', 1, 'Descripción del evento 6', 'event_images/imagen6.jpg', '1234', 1, 'evento-6', NULL, '2024-03-04 00:17:08', '2024-03-04 00:17:08'),
('Evento 7', '2024-03-03 19:18:00', '2024-03-08 19:18:00', 1, 'Descripción del evento 7', 'event_images/imagen7.jpg', '1234', 1, 'evento-7', NULL, '2024-03-04 00:19:22', '2024-03-04 00:19:22'),
('Evento 8', '2024-03-03 19:20:00', '2024-03-07 19:20:00', 1, 'Descripción del evento 8', 'event_images/imagen8.jpg', '1234', 1, 'evento-8', NULL, '2024-03-04 00:20:55', '2024-03-04 00:20:55'),
('Evento 9', '2024-03-03 19:15:00', '2024-03-04 19:15:00', 1, 'Descripción del evento 9', 'event_images/imagen9.jpg', '1234', 1, 'evento-9', NULL, '2024-03-04 00:17:08', '2024-03-04 00:17:08'),
('Evento 10', '2024-03-03 19:18:00', '2024-03-08 19:18:00', 1, 'Descripción del evento 10', 'event_images/imagen10.jpg', '1234', 1, 'evento-10', NULL, '2024-03-04 00:19:22', '2024-03-04 00:19:22')
");

        // Insertar relaciones events_has_project_field
        $relationships = [
            [1, 1], [1, 2], [1, 3], [1, 4], [1, 5], [1, 6], [1, 7], [1, 8], [1, 9], [1, 10],
            [2, 1], [2, 2], [2, 3], [2, 4], [2, 5], [2, 6], [2, 7], [2, 8], [2, 9], [2, 10],
            [3, 1], [3, 2], [3, 3], [3, 4], [3, 5], [3, 6], [3, 7], [3, 8], [3, 9], [3, 10],
            // Insertar las relaciones restantes aquí
        ];

        foreach ($relationships as $relationship) {
            DB::table('events_has_project_field')->updateOrInsert(
                ['events_id' => $relationship[0], 'project_field_id' => $relationship[1]],
                ['created_at' => null, 'updated_at' => null]
            );
        }


        // Insertar el proyecto
        $projectId = DB::table('projects')->insertGetId([
            'title' => 'Bus Unab App',
            'description' => 'Proyecto en aras de contribuir en el bus unab',
            'cover_image' => 'assets/docs-default/proyecto.jpg',
            'created_at' => '2024-03-04 00:51:44',
            'updated_at' => '2024-03-04 00:51:44',
        ]);

        // Insertar eventos_has_projects
        DB::table('events_has_projects')->insert([
            'events_id' => 1,
            'projects_id' => $projectId,
        ]);

        // Insertar project_authors
        DB::table('project_authors')->insert([
            ['projects_id' => $projectId, 'users_id' => 8, 'created_at' => '2024-03-04 00:51:44', 'updated_at' => '2024-03-04 00:51:44'],
            ['projects_id' => $projectId, 'users_id' => 18, 'created_at' => '2024-03-04 00:51:44', 'updated_at' => '2024-03-04 00:51:44'],
            ['projects_id' => $projectId, 'users_id' => 1, 'created_at' => '2024-03-04 00:51:44', 'updated_at' => '2024-03-04 00:51:44'],
        ]);

        // Generar una fecha aleatoria en los últimos 365 días
        $createdAt = now()->subDays(rand(1, 30));
        $softwareEngineeringKeywords = [
            'Desarrollo', 'Software', 'Código', 'Programación', 'Algoritmo', 'Estructura', 'Datos', 'Compilador', 'Interprete', 'Lenguaje',
            'Depuración', 'Depurar', 'Optimización', 'Repositorio', 'Control', 'Versiones', 'Git', 'Subversion', 'Mercurial', 'Bitbucket',
            'GitHub', 'GitLab', 'Despliegue', 'Continuo', 'Integración', 'CI/CD', 'Automatización', 'Pruebas', 'Unitarias', 'Funcionales',
            'Regresión', 'Integración', 'Sistema', 'Gestión', 'Proyectos', 'Agile', 'Scrum', 'Kanban', 'Lean', 'DevOps', 'Infraestructura',
            'Nube', 'Servidor', 'Cliente', 'Arquitectura', 'Microservicios', 'Monolito', 'API', 'REST', 'SOAP', 'GraphQL', 'Framework',
            'Backend', 'Frontend', 'Fullstack', 'MVC', 'MVVM', 'Componentes', 'Librería', 'Dependencias', 'Package', 'Bundle', 'Middleware',
            'Servicio', 'API Gateway', 'Orquestación', 'Docker', 'Kubernetes', 'Contenedor', 'Escalabilidad', 'Rendimiento',
            'Seguridad', 'Criptografía', 'Autenticación', 'Autorización', 'OWASP', 'Vulnerabilidad', 'Ataque', 'Inyección', 'SQL',
            'Cross-Site Scripting', 'Cross-Site Request Forgery', 'XSS', 'CSRF', 'Red', 'TCP/IP', 'HTTP', 'HTTPS', 'SSH', 'Firewall', 'VPN',
            'Proxy', 'IDS', 'IPS', 'WAF', 'Monitorización', 'Logs', 'Métricas', 'Análisis', 'Disponibilidad', 'Resiliencia', 'Internet de las cosas', 'Iot', 'Ingenieria de software'
        ];

        $softwareEngineeringKeywords = array_unique($softwareEngineeringKeywords);

        // Insertar keywords en la base de datos
        foreach ($softwareEngineeringKeywords as $keywordName) {
            DB::table('keywords')->insert([
                'name' => $keywordName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }




        // Insertar projects_has_field
        DB::table('projects_has_field')->insert([
            ['projects_id' => $projectId, 'project_field_id' => 1, 'value' => 'Desarrolla runa aplicacion de ....'],
            ['projects_id' => $projectId, 'project_field_id' => 2, 'value' => 'objetivos específicos 1'],
            ['projects_id' => $projectId, 'project_field_id' => 3, 'value' => 'jjlkfajsdl lasjlfj sldjf lkasjd lfñ jasdñlkf jañsld fjñalsd jfñlk ajsdfñ jalksd jflañksdj fñl ajsdlfk asd'],
            ['projects_id' => $projectId, 'project_field_id' => 4, 'value' => 'ja sjdfljasdlk fjkldsj fkl adsjfk ljsdlkjfñlaksjdfñaioe fñlknlknvñ akjsdf'],
            ['projects_id' => $projectId, 'project_field_id' => 5, 'value' => 'kjalsdifosdflkasj dfa skdfjñlsjd fkajsñ lkjflsdjkflsjdfienfnzdjknfk'],
            ['projects_id' => $projectId, 'project_field_id' => 6, 'value' => 'jfalksdj flksnkf n'],
            ['projects_id' => $projectId, 'project_field_id' => 7, 'value' => 'assets/docs-default/Documento de referencia.pdf'],
            ['projects_id' => $projectId, 'project_field_id' => 8, 'value' => 'assets/docs-default/Documento de referencia.pdf'],
            ['projects_id' => $projectId, 'project_field_id' => 9, 'value' => 'assets/docs-default/Documento de referencia.pdf'],
            ['projects_id' => $projectId, 'project_field_id' => 10, 'value' => 'FASFASDF ASDFASD AFSD'],
            ['projects_id' => $projectId, 'project_field_id' => 11, 'value' => 'assets/docs-default/Documento de referencia.pdf'],
            ['projects_id' => $projectId, 'project_field_id' => 12, 'value' => 'https://github.com/inge-fabiansuarez/sistema-integral-proyectos-ingenieria-unab'],
            ['projects_id' => $projectId, 'project_field_id' => 13, 'value' => 'assets/docs-default/Documento de referencia.pdf'],
        ]);




        $projectNames = [
            'MessagingApp', 'PhotoEditor', 'NavigationApp', 'FitnessApp', 'CalendarApp',
            'ShoppingListApp', 'RecipeApp', 'LanguageApp', 'BudgetApp', 'HealthTrackerApp',
            'NewsApp', 'WeatherWidget', 'TaskTrackerApp', 'MusicStreamingApp', 'TravelGuideApp',
            'FoodDeliveryApp', 'ExpenseManager', 'NoteTakingApp', 'SocialNetworkingApp', 'GamingApp',
            'MessagingApp2', 'PhotoEditor2', 'NavigationApp2', 'FitnessApp2', 'CalendarApp2',
            'ShoppingListApp2', 'RecipeApp2', 'LanguageApp2', 'BudgetApp2', 'HealthTrackerApp2',
            'NewsApp2', 'WeatherWidget2', 'TaskTrackerApp2', 'MusicStreamingApp2', 'TravelGuideApp2',
            'FoodDeliveryApp2', 'ExpenseManager2', 'NoteTakingApp2', 'SocialNetworkingApp2', 'GamingApp2',
            'MessagingApp3', 'PhotoEditor3', 'NavigationApp3', 'FitnessApp3', 'CalendarApp3',
            'ShoppingListApp3', 'RecipeApp3', 'LanguageApp3', 'BudgetApp3', 'HealthTrackerApp3',
            'NewsApp3', 'WeatherWidget3', 'TaskTrackerApp3', 'MusicStreamingApp3', 'TravelGuideApp3',
            'FoodDeliveryApp3', 'ExpenseManager3', 'NoteTakingApp3', 'SocialNetworkingApp3', 'GamingApp3',

            'MessagingApp', 'PhotoEditor', 'NavigationApp', 'FitnessApp', 'CalendarApp',
            'ShoppingListApp', 'RecipeApp', 'LanguageApp', 'BudgetApp', 'HealthTrackerApp',
            'NewsApp', 'WeatherWidget', 'TaskTrackerApp', 'MusicStreamingApp', 'TravelGuideApp',
            'FoodDeliveryApp', 'ExpenseManager', 'NoteTakingApp', 'SocialNetworkingApp', 'GamingApp', 'SocialMedia', 'Ecommerce', 'FitnessTracker', 'WeatherApp', 'TaskManager', 'MusicPlayer', 'TravelPlanner', 'FoodDelivery', 'LanguageLearning', 'ExpenseTracker'
        ];

        // Obtener todos los IDs de las palabras clave
        $keywordIds = DB::table('keywords')->pluck('id')->toArray();

        foreach ($projectNames as $name) {
            // Generar una fecha aleatoria en los últimos 365 días
            $createdAt = now()->subDays(rand(1, 30));


            // Insertar el proyecto
            $projectId = DB::table('projects')->insertGetId([
                'title' => $name,
                'description' => 'Description for ' . $name,
                'cover_image' => 'assets/docs-default/proyecto.jpg',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Insertar eventos_has_projects
            DB::table('events_has_projects')->insert([
                'events_id' => 1,
                'projects_id' => $projectId,
            ]);

            // Insertar autores del proyecto (ejemplo)
            DB::table('project_authors')->insert([
                ['projects_id' => $projectId, 'users_id' => 1, 'created_at' => $createdAt, 'updated_at' => $createdAt],
                ['projects_id' => $projectId, 'users_id' => 2, 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ]);




            // Obtener una cantidad aleatoria de IDs de palabras clave (máximo 5)
            $randomKeywordIds = collect($keywordIds)->shuffle()->take(5)->toArray();

            // Insertar relaciones en la tabla pivot keyword_project
            foreach ($randomKeywordIds as $keywordId) {
                DB::table('keyword_project')->insert([
                    'keyword_id' => $keywordId,
                    'project_id' => $projectId,
                ]);
            }
        }







        $projectNames = [
            'FPSGame', 'AdventureQuest', 'RPGFantasy', 'PuzzleMania', 'ArcadeMania',
            'RacingRush', 'StrategyKingdom', 'SimulationCity', 'SportsMania', 'MMORPGWorld',
            'FightingFrenzy', 'PlatformerParadise', 'SurvivalSaga', 'HorrorHavoc', 'ActionArena',
            'FPSGame2', 'AdventureQuest2', 'RPGFantasy2', 'PuzzleMania2', 'ArcadeMania2',
            'RacingRush2', 'StrategyKingdom2', 'SimulationCity2', 'SportsMania2', 'MMORPGWorld2',
            'FightingFrenzy2', 'PlatformerParadise2', 'SurvivalSaga2', 'HorrorHavoc2', 'ActionArena2',
            'FPSGame3', 'AdventureQuest3', 'RPGFantasy3', 'PuzzleMania3', 'ArcadeMania3',
            'RacingRush3', 'StrategyKingdom3', 'SimulationCity3', 'SportsMania3', 'MMORPGWorld3',
            'FightingFrenzy3', 'PlatformerParadise3', 'SurvivalSaga3', 'HorrorHavoc3', 'ActionArena3',
            'SocialMedia', 'Ecommerce', 'FitnessTracker', 'WeatherApp', 'TaskManager', 'MusicPlayer', 'TravelPlanner', 'FoodDelivery', 'LanguageLearning', 'ExpenseTracker', 'FirstPersonShooter', 'RolePlayingGame', 'Platformer', 'SurvivalHorror', 'RealTimeStrategy',
            'MassivelyMultiplayerOnline', 'OpenWorldAdventure', 'Simulator', 'PuzzleGame', 'RacingGame',
            'SportsGame', 'EducationalGame', 'TextAdventure', 'VirtualRealityExperience', 'AugmentedRealityGame',
            'MobileGame', 'CasualGame', 'ActionAdventure', 'StrategyGame', 'IndieGame',
        ];


        foreach ($projectNames as $name) {
            // Generar una fecha aleatoria en los últimos 30 días
            $createdAt = now()->subDays(rand(1, 30));
            // Insertar el proyecto
            $projectId = DB::table('projects')->insertGetId([
                'title' => $name,
                'description' => 'Description for ' . $name,
                'cover_image' => 'assets/docs-default/proyecto.jpg',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Insertar eventos_has_projects para el evento con ID 2
            DB::table('events_has_projects')->insert([
                'events_id' => 2,
                'projects_id' => $projectId,
            ]);

            // Insertar autores del proyecto (ejemplo)
            DB::table('project_authors')->insert([
                ['projects_id' => $projectId, 'users_id' => 1, 'created_at' => $createdAt, 'updated_at' => $createdAt],
                ['projects_id' => $projectId, 'users_id' => 2, 'created_at' => $createdAt, 'updated_at' => $createdAt],
            ]);

            // Obtener una cantidad aleatoria de IDs de palabras clave (máximo 5)
            $randomKeywordIds = collect($keywordIds)->shuffle()->take(rand(1, 20))->toArray();

            // Insertar relaciones en la tabla pivot keyword_project
            foreach ($randomKeywordIds as $keywordId) {
                DB::table('keyword_project')->insert([
                    'keyword_id' => $keywordId,
                    'project_id' => $projectId,
                ]);
            }
        }
    }
}
