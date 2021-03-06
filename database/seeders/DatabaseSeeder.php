<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('/public/salidas');
        Storage::deleteDirectory('/public/entradas');

        // Nivel 0
        $this->call(PersonaSeeder::class);

        $this->call(CargoJuradoSeeder::class);
        $this->call(CategoriaEstadoSeeder::class);
        $this->call(ColegioSeeder::class);
        $this->call(FacultadSeeder::class);
        $this->call(FinanciadorSeeder::class);
        $this->call(FrecuenciaSeeder::class);
        $this->call(GradoAcademicoSeeder::class);
        //    \App\Models\Investigador::factory(50)->create();
        $this->call(ProcesoSeeder::class);
        $this->call(SemestreSeeder::class);
        $this->call(TipoActividadSeeder::class);
        $this->call(TipoInstitucionSeeder::class);
        $this->call(TipoSolicitudSeeder::class);
        $this->call(TipoTesisSeeder::class);
        $this->call(UnidadMedidaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //      \App\Models\Empresa::factory(50)->create();

        // Nivel 1
        $this->call(ActividadSeeder::class);
        $this->call(AreaInvestigacionSeeder::class);
        $this->call(EncuestaPreguntaSeeder::class);
        $this->call(EntradaSeeder::class);
        $this->call(EscuelaSeeder::class);
        $this->call(EstadoSeeder::class);
        //Factory de GradoEstudiante
//        \App\Models\Institucion::factory(25)->create();
//        \App\Models\Jurado::factory(25)->create();
        $this->call(RequisitoSeeder::class);
        $this->call(SalidaSeeder::class);

        //Solicitudes
//        \App\Models\GradoEstudiante::factory(350)->create();
//        \App\Models\Solicitud::factory(300)->create();

        // Nivel 2
//      //  $this->call(ConvalidacionSeeder::class);
        $this->call(EntidadSeeder::class);
//        \App\Models\EstudianteExterno::factory(50)->create();
        $this->call(IndicadorSeeder::class);
        $this->call(LineaInvestigacionSeeder::class);
//        \App\Models\ResponsabilidadSocial::factory(50)->create();
//        \App\Models\Tesis::factory(50)->create();
        $this->call(CicloSeeder::class);
        $this->call(CursoSeeder::class);


        // Nivel 3
//      //  \App\Models\ConvalidacionPostulante::factory(75)->create();
        $this->call(EntidadableSeeder::class);
        $this->call(IndicadorableSeeder::class);
        $this->call(ResponsableSeeder::class);
//        \App\Models\RsuParticipante::factory(75)->create();
        $this->call(SublineaInvestigacionSeeder::class);
//        \App\Models\Sustentacion::factory(30)->create();

        // Nivel 4
        $this->call(ResponsableSalidaSeeder::class);
        $this->call(ClienteSeeder::class);
//        \App\Models\Investigacion::factory(30)->create();
//        \App\Models\JuradoSustentacion::factory(90)->create();
        $this->call(ProveedorSeeder::class);

        // Nivel 5
//        \App\Models\InvestigacionFinanciacion::factory(90)->create();
//        \App\Models\InvestigacionInvestigador::factory(90)->create();

        //Sprint 3
        $this->call(ServicioSeeder::class);

        // Sprint 3
        $this->call(DepartamentoSeeder::class);
        $this->call(DocenteCategoriaSeeder::class);
        $this->call(DocenteDedicacionSeeder::class);
        $this->call(DocenteCondicionSeeder::class);

        $this->call(DocenteSeeder::class);
    }
}
