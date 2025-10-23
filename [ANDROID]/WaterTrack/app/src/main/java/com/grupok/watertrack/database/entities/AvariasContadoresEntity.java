package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "AVARIAS_contadores")
public class AvariasContadoresEntity {

    @PrimaryKey(autoGenerate = true)
    public int id;

    @ColumnInfo(name = "id_contador")
    public int idContador;

    @ColumnInfo(name = "id_morador")
    public int idMorador;

    @ColumnInfo(name = "descricao")
    public String descricao;

    public AvariasContadoresEntity(int idContador, int idMorador, String descricao) {
        this.idContador = idContador;
        this.idMorador = idMorador;
        this.descricao = descricao;
    }
}
