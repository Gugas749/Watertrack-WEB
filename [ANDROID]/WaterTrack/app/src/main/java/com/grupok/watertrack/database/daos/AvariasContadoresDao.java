package com.grupok.watertrack.database.daos;

import androidx.room.Dao;
import androidx.room.Insert;
import androidx.room.Query;
import androidx.room.Update;

import com.grupok.watertrack.database.entities.AvariasContadoresEntity;

import java.util.List;

@Dao
public interface AvariasContadoresDao {

    @Insert
    void insert(AvariasContadoresEntity avariaContador);

    @Insert
    void insertList(List<AvariasContadoresEntity> avariasContadores);

    @Update
    void update(AvariasContadoresEntity avariaContador);

    @Query("SELECT * FROM AVARIAS_contadores")
    List<AvariasContadoresEntity> getAvariasContadores();

    @Query("DELETE FROM AVARIAS_contadores")
    void clearAllEntries();
}
