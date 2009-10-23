#!/bin/bash
# Scirpt de ejemplo para arancar un sistema operativo instalado.
# (puede usarse como base para el programa de arranque usado por OpenGNSys Admin).

PROG="$(basename $0)"
if [ $# -ne 2 ]; then
    ogRaiseError $OG_ERR_FORMAT "Formato: $PROG ndisco nparticion"
    exit $?
fi

# Procesos previos.
PART=$(ogDiskToDev $1 $2) | exit $?

# Arrancar.
ogEcho info "$PROG: Desmontar todos los sistemas operativos del disco."
ogUnmountAll $1 | exit $?
if [ "$(ogGetOsType $1 $2)" = "Windows" ]; then
    ogEcho info "$PROG: Activar partición de Windows $PART."
    ogSetPartitionActive $1 $2
    ogEcho info "$PROG: Comprobar sistema de archivos."
    ogCheckFs $1 $2
fi
ogEcho info "$PROG: Arrancar sistema operativo."
ogBoot $1 $2

