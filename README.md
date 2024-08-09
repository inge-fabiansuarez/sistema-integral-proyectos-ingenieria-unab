# [Elaborado por Fabián Suárez](https://www.linkedin.com/in/inge-fabiansuarez/)

## Sistema Integral de Evaluación de Proyectos de Ingeniería en la UNAB

El presente estudio se enfoca en investigar la efectividad de la implementación de un software integral de evaluación y seguimiento de proyectos de ingeniería en el ámbito académico fortaleciendo la gestión curricular en la UNAB.

La evaluación y calificación de los proyectos de clase en entornos educativos ha sido objeto de análisis y discusión en diversos contextos. La necesidad de contar con un proceso de evaluación claro, coherente y estandarizado se considera fundamental para garantizar la calidad y equidad educativa. Investigaciones previas han resaltado la importancia de una planificación adecuada y mecanismos de control en la concepción de proyectos, la planificación sólida y detallada permite establecer objetivos claros, identificar los recursos necesarios y definir las etapas del proyecto. Además, un enfoque riguroso en los mecanismos de control contribuye a un seguimiento efectivo y una evaluación precisa del progreso y los resultados del proyecto.

La tecnología como herramienta de evaluación en proyectos de clase también ha sido destacada en la literatura educativa, se subraya la importancia de contar con: criterios y pautas claras para garantizar equidad y objetividad en la calificación, la coordinación entre docentes para establecer una unificación en la aplicación de la evaluación, la colaboración entre docentes, coordinación, la comparación y el análisis de resultados.

Esta investigación estará guiada por un diseño cuasi experimental aplicado a la ingeniería de software para analizar la efectividad de la herramienta en el contexto académico.

  

## Manual de Implementación o Instalación



  

1. Unzip the downloaded archive

2. Copy and paste **soft-ui-dashboard-laravel-master** folder in your **projects** folder. Rename the folder to your project's name

3. In your terminal run `composer install`

4. Copy `.env.example` to `.env` and updated the configurations (mainly the database configuration)

5. In your terminal run `php artisan key:generate`

6. Run `php artisan migrate --seed` to create the database tables and seed the roles and users tables

7. Run `php artisan storage:link` to create the storage symlink (if you are using **Vagrant** with **Homestead** for development, remember to ssh into your virtual machine and run the command from there).

  


## Navegadores Soportados


  

<img  src="https://s3.amazonaws.com/creativetim_bucket/github/browser/chrome.png"  width="64"  height="64">  <img  src="https://s3.amazonaws.com/creativetim_bucket/github/browser/firefox.png"  width="64"  height="64">  <img  src="https://s3.amazonaws.com/creativetim_bucket/github/browser/edge.png"  width="64"  height="64">  <img  src="https://s3.amazonaws.com/creativetim_bucket/github/browser/safari.png"  width="64"  height="64">  <img  src="https://s3.amazonaws.com/creativetim_bucket/github/browser/opera.png"  width="64"  height="64">

  
## Creditos

  

- [Fabián Enrique Suárez Carvajal](https://www.linkedin.com/in/inge-fabiansuarez)
