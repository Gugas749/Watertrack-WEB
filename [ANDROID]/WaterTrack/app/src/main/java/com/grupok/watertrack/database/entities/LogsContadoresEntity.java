package com.grupok.watertrack.database.entities;

import androidx.room.ColumnInfo;
import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity(tableName = "LOGS_contadores")
public class LogsContadoresEntity {

    @PrimaryKey(autoGenerate = true)
    public long id;

    @ColumnInfo(name = "id_contador")
    public long idContador;

    @ColumnInfo(name = "leitura")
    public String leitura;

    @ColumnInfo(name = "consumo_acumulado")
    public String consumoAcumulado;

    @ColumnInfo(name = "data")
    public String data;

    @ColumnInfo(name = "pressao_agua")
    public String pressaoAgua;

    @ColumnInfo(name = "descricao")
    public String descricao;

    @ColumnInfo(name = "foiAvaria")
    public boolean foiAvaria;

    public LogsContadoresEntity(long idContador, String leitura, String consumoAcumulado,
                                String data, String pressaoAgua, String descricao, boolean foiAvaria) {
        this.idContador = idContador;
        this.leitura = leitura;
        this.consumoAcumulado = consumoAcumulado;
        this.data = data;
        this.pressaoAgua = pressaoAgua;
        this.descricao = descricao;
        this.foiAvaria = foiAvaria;
    }
}
