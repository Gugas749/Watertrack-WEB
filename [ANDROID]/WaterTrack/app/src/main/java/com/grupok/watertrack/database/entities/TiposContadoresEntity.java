package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "TIPOS_contadores")
public class TiposContadoresEntity {

    @PrimaryKey(autoGenerate = true)
    public long id;

    @ColumnInfo(name = "descricao")
    public String descricao;

    public TiposContadoresEntity(String descricao) {
        this.descricao = descricao;
    }
}
