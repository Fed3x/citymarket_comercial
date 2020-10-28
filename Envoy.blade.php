@servers(['server' => 'administrador@192.168.210.62'])


@task('foo', ['on' => 'server'])
    cd /home/administrador/data-integration/
    ./kitchen.sh /file:"/home/administrador/Escritorio/PDI_PRODUCCION_{{ $area_trabajo }}/{{ $trabajo }}.kjb" /param:fecha_i="{{ $fecha_i }}" /param:fecha_f="{{ $fecha_f }}" /param:serial="{{ $serial }}" /param:correos="{{ $correos }}" /param:productos="{{ $productos }}" > /dev/null 2>&1
    echo {{$correos}}
@endtask

