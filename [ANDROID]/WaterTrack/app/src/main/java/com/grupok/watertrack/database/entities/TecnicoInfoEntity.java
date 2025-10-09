package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "Tecnico_Info")
public class TecnicoInfoEntity {

    @PrimaryKey(autoGenerate = true)
    public int id;

    @ColumnInfo(name = "id_user")
    public int idUser;

    @ColumnInfo(name = "id_empresa")
    public int idEmpresa;

    @ColumnInfo(name = "num_cedula_profissional")
    public String numCedulaProfissional;

    public TecnicoInfoEntity(int idUser, int idEmpresa, String numCedulaProfissional) {
        this.idUser = idUser;
        this.idEmpresa = idEmpresa;
        this.numCedulaProfissional = numCedulaProfissional;
    }
}
