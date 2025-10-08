package com.grupok.watertrack.database.daos;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import com.grupok.watertrack.database.entities.TecnicoInfoEntity;

import java.util.List;

@Dao
public interface TecnicoInfoDao {

    @Insert
    void insert(TecnicoInfoEntity tecnicoInfo);

    @Insert
    void insertList(List<TecnicoInfoEntity> tecnicosInfo);

    @Update
    void update(TecnicoInfoEntity tecnicoInfo);

    @Query("SELECT * FROM Tecnico_Info")
    List<TecnicoInfoEntity> getTecnicosInfo();

    @Query("DELETE FROM Tecnico_Info")
    void clearAllEntries();
}
