package com.grupok.watertrack.fragments.mainactivityfrags.detailscontadorview;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RadioButton;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.grupok.watertrack.R;
import com.grupok.watertrack.database.entities.LogsContadoresEntity;

import java.util.List;

public class RVAdapterReadingsACReadingsContadores extends RecyclerView.Adapter<RVAdapterReadingsACReadingsContadores.ViewHolder> {

    private final Context context;
    private final List<LogsContadoresEntity> logsList;
    private int selectedPosition = 0;
    private final OnLeituraSelecionada listener;

    public interface OnLeituraSelecionada {
        void onSelect(LogsContadoresEntity leitura);
    }

    public RVAdapterReadingsACReadingsContadores(Context context, List<LogsContadoresEntity> logsList, OnLeituraSelecionada listener) {
        this.context = context;
        this.logsList = logsList;
        this.listener = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.rv_row_readings_readingscontadores, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, int position) {
        LogsContadoresEntity log = logsList.get(position);
        holder.data.setText(log.data);
        holder.radioButton.setChecked(position == selectedPosition);

        View.OnClickListener clickListener = v -> {
            int oldPos = selectedPosition;
            selectedPosition = holder.getAdapterPosition();
            notifyItemChanged(oldPos);
            notifyItemChanged(selectedPosition);
            listener.onSelect(log);
        };

        holder.radioButton.setOnClickListener(clickListener);
        holder.itemView.setOnClickListener(clickListener);
    }

    @Override
    public int getItemCount() {
        return logsList.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        RadioButton radioButton;
        TextView data;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            radioButton = itemView.findViewById(R.id.radioData_rvRowReadings_ReadingsContadores);
            data = itemView.findViewById(R.id.textView_Data_rvRowReadings_ReadingsContadores);
        }
    }
}
