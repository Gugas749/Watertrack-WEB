package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "AVARIAS_contadores")
public class AvariasContadoresEntity {

    @PrimaryKey(autoGenerate = true)
    public long id;

    @ColumnInfo(name = "id_contador")
    public long idContador;

    @ColumnInfo(name = "id_morador")
    public Long idMorador;

    @ColumnInfo(name = "descricao")
    public String descricao;

    public AvariasContadoresEntity(long idContador, Long idMorador, String descricao) {
        this.idContador = idContador;
        this.idMorador = idMorador;
        this.descricao = descricao;
    }
}
