package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "Tecnico_Info")
public class TecnicoInfoEntity {

    @PrimaryKey(autoGenerate = true)
    public long id;

    @ColumnInfo(name = "id_user")
    public long idUser;

    @ColumnInfo(name = "id_empresa")
    public Long idEmpresa;

    @ColumnInfo(name = "num_cedula_profissional")
    public String numCedulaProfissional;

    public TecnicoInfoEntity(long idUser, Long idEmpresa, String numCedulaProfissional) {
        this.idUser = idUser;
        this.idEmpresa = idEmpresa;
        this.numCedulaProfissional = numCedulaProfissional;
    }
}
